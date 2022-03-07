<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OnSaleController extends Controller
{
    public function index() {
        $sale = Sale::all();
        $home_Sale = Sale::first();
        $sel_Sale = @explode(',', $home_Sale->Sale);
        $no_of_products = @$home_Sale->no_of_products;

        return Inertia::render('Admin/OnSale', ['sale' => $sale]);
    }
    public function store(Request $request) {

        $data = [
            'sale_date' => $request->get('sale_date'),
            'status' => (int) $request->get('status')
        ];

//        Update or Insert
        $exists = Sale::find(1);
        if ($exists) {
            Sale::where('id', 1)->update($data);
        }else{
            Sale::create($data);
        }
        return redirect()->back()->with('successMessage', 'On sale updated.');
    }
}
