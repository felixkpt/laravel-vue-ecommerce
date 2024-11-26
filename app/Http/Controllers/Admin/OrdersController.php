<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Gloudemans\Shoppingcart\Facades\Cart;
use Inertia\Inertia;

class OrdersController extends Controller
{

    public function index()
    {
        $orders = Order::orderby('created_at', 'desc')->paginate(30);

        $title = 'Welcome to quick shoppers';
        $description = '';
        $data = ['orders' => $orders, 'title' => $title, 'description' => $description,];

        return Inertia::render('Admin/Orders', $data);
    }

    function ordersView()
    {
        $orders = Order::where('user_id', auth()->id())
            ->with('items') // Include related order items for better efficiency
            ->paginate();

        return Inertia::render('Account/Orders/Index', [
            'orders' => $orders,
        ]);
    }

    function ordersList()
    {
        $orders = Order::where('user_id', auth()->id())
            ->with('items') // Include related order items
            ->paginate();

        return response()->json([
            'status' => 'success',
            'orders' => $orders,
        ]);
    }

    function orderView($id)
    {
        $order = Order::with(['items' => function ($q) {
            $q->with('product');
        }])->find($id); // Fetch the order with items

        if (!$order) {
            return redirect()->route('account.orders')->withErrors([
                'error' => 'Order not found.',
            ]);
        }

        return Inertia::render('Account/Orders/View/Index', [
            'order' => $order,
            'items' => $order->items, // Pass related items directly
        ]);
    }

    /**
     * Finalize Checkout and create an order.
     */
    public function finalizeCheckout(Request $request)
    {

        $validated = $request->validate([
            'billing.fname' => 'required|string|max:255',
            'billing.lname' => 'required|string|max:255',
            'billing.email' => 'required|email',
            'billing.phone' => 'required|string|max:20',
            'billing.address' => 'required|string',
            'billing.country' => 'required|string',
            'billing.zip' => 'required|string|max:10',
            'billing.city' => 'required|string',
            'payment_method' => 'required|string|in:paypal,paystack',
            'payment_reference' => 'required|string',
            'cart.cart' => 'required|array',
        ]);

        // Create the Order
        $order = Order::create([
            'first_name' => $validated['billing']['fname'],
            'last_name' => $validated['billing']['lname'],
            'email' => $validated['billing']['email'],
            'phone' => $validated['billing']['phone'],
            'address' => $validated['billing']['address'],
            'country' => $validated['billing']['country'],
            'zip' => $validated['billing']['zip'],
            'city' => $validated['billing']['city'],
            'payment_method' => $validated['payment_reference'],
            'payment_reference' => $validated['payment_reference'],
            'total_amount' => collect($validated['cart']['cart'])->sum('subtotal'),
            'user_id' => auth()->id(),
        ]);

        // Create Order Items
        $items = [];
        foreach ($validated['cart']['cart'] as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['qty'],
                'price' => $item['price'],
                'subtotal' => $item['subtotal'],
            ]);

            $items[] = [
                'name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['qty'],
                'subtotal' => $item['subtotal'],
            ];
        }

        Cart::destroy();

        return redirect()->to('account/orders/view/' . $order->id);
    }


    function checkoutSuccess()
    {
        return Inertia::render('CheckoutSuccess', []);
    }

    /**
     * Get all orders.
     */
    public function getAllOrders()
    {
        $orders = Order::with('items')->get();

        return response()->json(['status' => 'success', 'orders' => $orders]);
    }

    /**
     * Get an order by ID.
     */
    public function getOrderById($id)
    {
        $order = Order::with('items')->find($id);

        if (!$order) {
            return response()->json(['status' => 'error', 'message' => 'Order not found.'], 404);
        }

        return response()->json(['status' => 'success', 'order' => $order]);
    }

    function updateStatus($id)
    {
        Order::with('items')->findorfail($id)->update(['status' => request()->status]);

        return redirect()->back();
    }
}
