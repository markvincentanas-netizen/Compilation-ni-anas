<?php

namespace App\Http\Controllers;

use App\Models\Grocery;
use Illuminate\Http\Request;

class GroceryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $groceries = Grocery::when($search, function ($query) use ($search) {
            $query->where('name', 'like', "%$search%")
                  ->orWhere('category', 'like', "%$search%");
        })->paginate(5);

        return view('groceries.index', compact('groceries', 'search'));
    }

    public function create()
    {
        return view('groceries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'expiry_date' => 'required|date',
            'image' => 'image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        Grocery::create($data);

        return redirect()->route('groceries.index')->with('success', 'Added!');
    }

    public function show(Grocery $grocery)
    {
        return view('groceries.show', compact('grocery'));
    }

    public function edit(Grocery $grocery)
    {
        return view('groceries.edit', compact('grocery'));
    }

    public function update(Request $request, Grocery $grocery)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'expiry_date' => 'required|date',
            'image' => 'image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        $grocery->update($data);

        return redirect()->route('groceries.index')->with('success', 'Updated!');
    }

    public function destroy(Grocery $grocery)
    {
        $grocery->delete();
        return redirect()->route('groceries.index')->with('success', 'Deleted!');
    }

    public function dashboard()
{
    $totalItems = \App\Models\Grocery::count();
    $lowStock = \App\Models\Grocery::where('quantity', '<', 5)->count();
    $expired = \App\Models\Grocery::where('expiry_date', '<', date('Y-m-d'))->count();

    return view('dashboard', compact('totalItems', 'lowStock', 'expired'));
}
}