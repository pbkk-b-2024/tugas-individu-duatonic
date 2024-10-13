<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $items = Item::search($search)->paginate(20);

        return view('main.items', compact('items'));
    }

    public function add()
    {
        $categories = Category::all();
        return view('main.partials.item-add', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'item_price' => ['required', 'numeric', 'min:0'],
            'item_quantity' => ['required', 'integer', 'min:0'],
        ]);

        Item::create([
            'item_name' => $request->item_name,
            'category_id' => $request->category,
            'item_price' => $request->item_price,
            'item_quantity' => $request->item_quantity,
        ]);

        return redirect()->route('items.index')->with('success', 'Item added successfully.');
    }

    public function edit($id)
    {
        $item = Item::findOrFail($id);
        $categories = Category::all();

        return view('main.partials.item-edit', compact('item', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'item_name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'item_price' => ['required', 'numeric', 'min:0'],
            'item_quantity' => ['required', 'integer', 'min:0'],
        ]);
        
        $item = Item::findOrFail($id);

        $item->update([
            'item_name' => $request->item_name,
            'category_id' => $request->category,
            'item_price' => $request->item_price,
            'item_quantity' => $request->item_quantity,
        ]);

        \Log::info('Item updated', ['id' => $item->item_id]);

        return redirect()->route('items.index')->with('success', 'Item updated successfully.');
    }

    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        \Log::info('Item deleted', ['id' => $item->item_id]);

        return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
    }

}
