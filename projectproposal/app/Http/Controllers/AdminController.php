<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MenuItem;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $totalMenuItems = MenuItem::count();

        return view('admin.dashboard', compact('totalOrders', 'pendingOrders', 'totalMenuItems'));
    }

    // Menu Management
    public function menuIndex()
    {
        $categories = Category::with('menuItems')->get();
        return view('admin.menu.index', compact('categories'));
    }

    public function menuCreate()
    {
        $categories = Category::all();
        return view('admin.menu.create', compact('categories'));
    }

    public function menuStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id'
        ]);

        MenuItem::create($request->only(['name', 'description', 'price', 'category_id', 'available']) + [
            'image' => $request->image ?? 'https://picsum.photos/300/200'
        ]);

        return redirect()->route('admin.menu.index')->with('success', 'Menu item added!');
    }

    public function menuEdit(MenuItem $menuItem)
    {
        $categories = Category::all();
        return view('admin.menu.edit', compact('menuItem', 'categories'));
    }

    public function menuUpdate(Request $request, MenuItem $menuItem)
{
    $request->validate([
        'name'        => 'required|string|max:255',
        'price'       => 'required|numeric|min:0',
        'category_id' => 'required|exists:categories,id',
        'description' => 'nullable|string',
        'image'       => 'nullable|string',
    ]);

    $menuItem->update([
        'name'        => $request->name,
        'description' => $request->description,
        'price'       => $request->price,
        'category_id' => $request->category_id,
        'image'       => $request->image ?? $menuItem->image,
        'available'   => $request->has('available'),   // This fixes the 'on' issue
    ]);

    return redirect()->route('admin.menu.index')
                     ->with('success', 'Menu item updated successfully!');
}

    public function menuDestroy(MenuItem $menuItem)
    {
        $menuItem->delete();
        return redirect()->route('admin.menu.index')->with('success', 'Menu item deleted!');
    }

    // Orders Management
    public function orders()
    {
        $orders = Order::with('items.menuItem')->latest()->get();
        return view('admin.orders', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order)
{
    $request->validate([
        'status' => 'required|in:pending,preparing,ready,completed'
    ]);

    $order->update([
        'status' => $request->status
    ]);

    return redirect()->back()->with('success', 'Order status updated to ' . ucfirst($request->status) . '!');
}
}