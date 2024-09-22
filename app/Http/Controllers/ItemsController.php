<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Items;

class ItemsController extends Controller
{
    public function index(Request $request)
    {
        $searchTerm = $request->input('search');

        $data['items'] = Items::search($searchTerm)->paginate(20); // Fetch all items from the database

        return view('sidebar-components.items', compact('data'));
    }

    public function add()
    {
        return view('sidebar-components.items-add');
    }

    // Show the form to edit an existing item
    public function edit($item_id)
    {
        $item = Items::findOrFail($item_id);
        return view('sidebar-components.items-edit', compact('item'));
    }

    public function destroy($item_id)
    {
        $item = Items::findOrFail($item_id); // Find the item by its ID
        $item->delete(); // Delete the item from the database
        return redirect()->back()->with('success', 'Item deleted successfully');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'category' => 'required|string|max:100',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
        ]);

        Items::create([
            'item_name' => $request->name,
            'item_category' => $request->category,
            'item_price' => $request->price,
            'item_quantity' => $request->quantity,
        ]);

        return redirect()->route('items')->with('success', 'Item added successfully.');
    }

    // Update the specified item in the database
    public function update(Request $request, $item_id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
        ]);

        $item = Items::findOrFail($item_id);
        $item->update([
            'item_name' => $request->name,
            'item_category' => $request->category,
            'item_price' => $request->price,
            'item_quantity' => $request->quantity,
        ]);

        return redirect()->route('items')->with('success', 'Item updated successfully.');
    }
}