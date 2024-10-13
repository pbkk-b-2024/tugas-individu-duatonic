<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Redirect;

class ItemController extends Controller
{
    public function index(Request $request): Response
    {
        $search = $request->input('search');
        $items = Item::search($search);
        $items = $items->paginate(10);

        return Inertia::render('Items', [
            'items' => $items,
            'search' => $search,
            'can' => [
                'isAdmin' => $request->user()->can('isAdmin', \App\Models\User::class),
            ],
            'meta' => [
                'current_page' => $items->currentPage(),
                'from' => $items->firstItem(),
                'to' => $items->lastItem(),
                'total' => $items->total(),
                'last_page' => $items->lastPage(),
                'per_page' => $items->perPage(),
            ],
        ]);
    }

    public function add()
    {
        return Inertia::render('Item-Add', [
            'errors' => session('errors'),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_name' => ['required', 'string', 'max:255'],
            'item_category' => ['required', 'string', 'max:255'],
            'item_price' => ['required', 'numeric', 'min:0'],
            'item_quantity' => ['required', 'integer', 'min:0'],
        ]);

        Item::create([
            'item_name' => $request->item_name,
            'item_category' => $request->item_category,
            'item_price' => $request->item_price,
            'item_quantity' => $request->item_quantity,
        ]);

        return Redirect::route('items.index')->with('success', 'Item added successfully.');
    }

    public function edit($id)
    {
        $item = Item::findOrFail($id);
        return Inertia::render('Item-Edit', [
            'item' => $item,
            'errors' => session('errors'),
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'item_name' => ['required', 'string', 'max:255'],
            'item_category' => ['required', 'string', 'max:255'],
            'item_price' => ['required', 'numeric', 'min:0'],
            'item_quantity' => ['required', 'integer', 'min:0'],
        ]);
        
        $item = Item::findOrFail($id);

        $item->update([
            'item_name' => $request->item_name,
            'item_category' => $request->item_category,
            'item_price' => $request->item_price,
            'item_quantity' => $request->item_quantity,
        ]);

        \Log::info('Item updated', ['id' => $item->item_id]);

        return Redirect::route('items.index')->with('success', 'Item updated successfully.');
    }

    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        \Log::info('Item deleted', ['id' => $item->item_id]);

        return Redirect::route('items.index')->with('success', 'Item deleted successfully.');
    }

}
