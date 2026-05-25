<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function cart()
    {
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }

    public function addToCart(Request $request)
    {
        $cart = session()->get('cart', []);
        $menuItem = MenuItem::findOrFail($request->id);

        if (isset($cart[$request->id])) {
            $cart[$request->id]['quantity']++;
        } else {
            $cart[$request->id] = [
                'name' => $menuItem->name,
                'price' => $menuItem->price,
                'quantity' => 1,
                'image' => $menuItem->image ?? 'https://picsum.photos/80/80'
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Item added to cart!');
    }

    public function removeFromCart(Request $request)
    {
        $cart = session()->get('cart', []);
        unset($cart[$request->id]);
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Item removed from cart!');
    }

    public function placeOrder(Request $request)
{
    $cart = session('cart');
    if (!$cart) {
        return redirect()->back()->with('error', 'Cart is empty!');
    }

    $total = 0;
    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }

    $order = Order::create([
        'order_number'   => 'ORD-' . strtoupper(substr(uniqid(), -6)),
        'customer_name'  => $request->customer_name ?? Auth::user()->name,
        'table_number'   => $request->table_number,
        'order_type'     => $request->order_type ?? 'take-out',   // New field
        'total_amount'   => $total,
        'status'         => 'pending'
    ]);

    foreach ($cart as $id => $details) {
        OrderItem::create([
            'order_id' => $order->id,
            'menu_item_id' => $id,
            'quantity' => $details['quantity'],
            'price' => $details['price']
        ]);
    }

    session()->forget('cart');

    return redirect()->route('order.success', $order->id)
                     ->with('success', 'Order placed successfully!');
}
    public function success($id)
    {
        $order = Order::with('items.menuItem')->findOrFail($id);
        return view('order.success', compact('order'));
    }

    public function myOrders()
{
    $orders = Order::where('customer_name', Auth::user()->name)
                    ->with('items.menuItem')
                    ->latest()
                    ->get();

    return view('orders.my-orders', compact('orders'));
}
}