<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\SubCategory;
use App\Services\ClientHelper\Client;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Inertia\Inertia;

class AddProductController extends Controller
{

    private $max_words_des = 100;
    private $max_words = 1000;

    public function index()
    {

        $categories = Category::all();

        $title = 'Welcome to quick shoppers';
        $description = '';
        $data = ['categories' => $categories, 'title' => $title, 'description' => $description,];

        return Inertia::render('Admin/AddProduct', $data);
    }

    public function renderCreateProductFromJson()
    {

        $categories = Category::all();

        $title = 'Welcome to quick shoppers';
        $description = '';
        $data = ['categories' => $categories, 'title' => $title, 'description' => $description,];

        return Inertia::render('Admin/AddProductFromJson', $data);
    }

    public function store(Request $request)
    {

        $slug = $this->generateSlug($request->get('slug') ?: $request->get('name'));
        $request->merge(['slug' => $slug]);

        $rules = [
            'name' => 'required|min:3|max:100|unique:products,name',
            'slug' => 'required|min:3|max:120|unique:products,slug',
            'short_description' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    if (str_word_count($value) <= 1) {
                        $fail(ucfirst($attribute) . ' is less than 1 word');
                    }
                },
                function ($attribute, $value, $fail) {
                    if (str_word_count($value) >= $this->max_words_des) {
                        $fail(ucfirst($attribute) . ' is more than ' . $this->max_words_des . ' words');
                    }
                },
            ],
            'description' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    if (str_word_count($value) <= 1) {
                        $fail(ucfirst($attribute) . ' is less than 1 word');
                    }
                },
                function ($attribute, $value, $fail) {
                    if (str_word_count($value) >= $this->max_words) {
                        $fail(ucfirst($attribute) . ' is more than ' . $this->max_words . ' words');
                    }
                },
            ],
            'regular_price' => 'required|min:1',
            'sale_price' => 'nullable|numeric',
            'SKU' => 'required|min:1',
            'stock_status' => 'required',
            'quantity' => 'required|min:1',
            'image' => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
        ];

        $image_name = 'default.jpg';
        if ($request->hasFile('image')) {
            $rules = array_merge($rules, ['image' => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:2048']);
            $image_name = $request->file('image')->store('images/products', 'public');
        }

        $this->validate($request, $rules);

        $data = [
            'name' => $request->get('name'),
            'slug' => $request->get('slug'),
            'short_description' => $request->get('short_description'),
            'description' => $request->get('description'),
            'regular_price' => $request->get('regular_price'),
            'sale_price' => $request->get('sale_price'),
            'SKU' => $request->get('SKU'),
            'stock_status' => $request->get('stock_status'),
            'quantity' => $request->get('quantity'),
            'category_id' => $request->get('category_id'),
        ];

        if ($request->hasFile('image')) {
            $data = array_merge($data, ['image' => asset('uploads/' . $image_name)]);
        }

        // var_dump($data);die;

        Product::create($data);
        return redirect()->route('admin.products')->with('successMessage', 'Added Product.');
    }

    public function createProductFromJson(Request $request)
    {

        // Validate the array of products
        $validatedData = $this->validate($request, [
            'products' => 'required|array|min:1', // Ensure the 'products' key exists and is an array
            'products.*.name' => 'required|min:3|max:255|unique:products,name',
            'products.*.images' => 'required|array|min:1',
            'products.*.images.0' => 'required|url', // At least one valid URL in images array
            'products.*.about' => 'required|string|min:10',
            'products.*.rating' => 'required|numeric|min:0|max:5',
            'products.*.review_counts' => 'required|numeric|min:0',
            'products.*.base_price' => '`nullable`|numeric|min:0',
            'products.*.sale_price' => 'required|numeric|min:0',
            'products.*.category' => 'required|string|max:100',
            'products.*.sub_category' => 'nullable|string|max:100',
        ]);

        // If validation passes, loop through the products and create them
        foreach ($validatedData['products'] as $productData) {
            $this->createProduct($productData);
        }

        return redirect()->route('admin.products')->with('successMessage', 'Added Products.');
    }

    function createProduct($validatedData)
    {
        // Extract the first image from the images array
        $imageUrl = $validatedData['images'][0];

        // Download and save the image locally
        $imagePath = '/storage/' . $this->downloadImage($imageUrl);

        $category_id = $this->getCategoryId($validatedData['category']);
        $subcategory_id = null;
        if ($validatedData['sub_category'] ?? null) {
            $subcategory_id = $this->getSubCategoryId($validatedData['sub_category'], $category_id);
        }

        // Check if the result is an integer or a float
        $sale_price = $validatedData['sale_price'] * 0.27;

        if ($sale_price >= 1) {
            $sale_price = (int) round($sale_price);
        }

        $base_price = $validatedData['base_price'] ?? $sale_price;

        // Prepare the product data
        $data = [
            'name' => $validatedData['name'],
            'slug' => $this->generateSlug($validatedData['name']),
            'short_description' => Str::limit($validatedData['about'], 200, '...'),
            'description' => $validatedData['about'],
            'image' => $imagePath,
            'category_id' => $category_id, // Helper function to get category ID
            'subcategory_id' => $subcategory_id, // Optional
            'sale_price' => $sale_price,
            'regular_price' => $base_price,
            'SKU' => $this->generateSKU($validatedData['name'], $category_id),
            'rating' => $validatedData['rating'],
            'review_counts' => $validatedData['review_counts'],
            'stock_status' => (rand(1, 100) <= 70) ? 'in_stock' : 'out_of_stock',

        ];

        // Create the product in the database
        Product::create($data);
    }

    private function downloadImage($source)
    {
        $fileName = basename($source);
        $dest = "images/products/" . $fileName;

        $path = Client::downloadFileFromUrl($source, $dest);

        return $path;
    }

    private function getCategoryId($categoryName)
    {
        return Category::firstOrCreate([
            'name' => $categoryName,
            'slug' => $this->generateSlug($categoryName),
        ])->id;
    }

    private function getSubCategoryId($subCategoryName, $categoryId)
    {
        if ($subCategoryName) {
            return SubCategory::firstOrCreate([
                'name' => $subCategoryName,
                'slug' => $this->generateSlug($subCategoryName),
                'category_id' => $categoryId, // Associate subcategory with the parent category
            ])->id;
        }
        return null;
    }

    public function generateSlug($str): string
    {
        return Str::slug($str);
    }

    function generateSKU($productName, $categoryId)
    {
        // Take the first three letters of the product name (uppercase, no spaces)
        $namePart = strtoupper(substr(preg_replace('/\s+/', '', $productName), 0, 3));

        // Combine with category ID and a random 4-digit number
        $randomNumber = rand(1000, 9999);
        $sku = $namePart . '-' . $categoryId . '-' . $randomNumber;

        return $sku;
    }
}
