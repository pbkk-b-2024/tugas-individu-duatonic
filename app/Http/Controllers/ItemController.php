<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

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
        return view('main.partials.item-add');
    }

    public function store()
    {
        $request->validate([
            'item_id' => ['required', 'string', 'max:6', 'unique:items,item_id'],
            'item_name' => ['required', 'string', 'max:255'],
            'item_category' => ['required', 'string', 'max:255'],
            'item_price' => ['required', 'numeric', 'min:0'],
            'item_quantity' => ['required', 'integer', 'min:0'],
        ]);

        Item::create([
            'item_id' => $request->item_id,
            'item_name' => $request->item_name,
            'item_category' => $request->item_category,
            'item_price' => $request->item_price,
            'item_quantity' => $request->item_quantity,
        ]);

        return redirect()->route('items.index')->with('success', 'Item added successfully.');
    }

    public function edit(Request $id)
    {
        $item = Item::findOrFail($id);

        return view('main.partials.item-edit', compact('item'));
    }

}
