<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order; // Assuming you have an Order model
use App\Models\OrderItem; // Assuming you have an OrderItem model
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class OrdersController extends Controller
{/**
 * Finalize Checkout and create an order.
 */
public function finalizeCheckout(Request $request)
{
    Log::info('RW', request()->all());
    
    $validated = $request->validate([
        'billing.fname' => 'required|string|max:255',
        'billing.lname' => 'required|string|max:255',
        'billing.email' => 'required|email',
        'billing.phone' => 'required|string|max:20',
        'billing.address' => 'required|string',
        'billing.country' => 'required|string',
        'billing.zip' => 'required|string|max:10',
        'billing.city' => 'required|string',
        'paymentMethod' => 'required|string|in:paypal,paystack',
        'paymentId' => 'required|string',
        'cart.cart' => 'required|array',
    ]);

    try {
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
            'payment_method' => $validated['paymentMethod'],
            'payment_id' => $validated['paymentId'],
            'total_amount' => collect($validated['cart']['cart'])->sum('subtotal'),
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

        // Render the Checkout Success page
        return Inertia::render('CheckoutSuccess', [
            'order' => $order,
            'items' => $items,
        ]);

    } catch (\Exception $e) {
        Log::error('Checkout error: ' . $e->getMessage());
        return response()->json(['status' => 'error', 'message' => 'Failed to place the order.'], 500);
    }
}


    function checkoutSuccess(){
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
}
