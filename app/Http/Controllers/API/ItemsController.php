<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Items;
use App\Http\Requests\NewItemRequest;
use App\Http\Resources\ItemResource;
// use App\Http\Requests\UpdateItemRequest;

class ItemsController
{
    public function index(Request $request)
    {
        $searchTerm = $request->input('search');

        $query = Items::search($searchTerm)->paginate(20); // Fetch all items from the database

        if (!$query) {
            return response()->json([
                'success' => false,
                'message' => 'Items not found',
            ], 404);
        }
        else {
            return response()->json($query);
        }

        // $query = ItemResource::collection($query);

        // return $query->additional([
        //     'success' => true,
        //     'message' => 'Items fetched successfully',
        // ]);
    }

    public function single($item_id)
    {
        $item = Items::findOrFail($item_id);

        if (!$item) {
            return response()->json([
                'success' => false,
                'message' => 'Item not found',
            ], 404);
        }
        else {
            return response()->json($item);
        }

        // return (new ItemResource($item))->additional([
        //     'success' => true,
        //     'message' => 'Item fetched successfully',
        // ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validated();
        $item = Items::create($validated);
        return (new ItemResource($item))->additional([
            'success' => true,
            'message' => 'Item added successfully',
        ]);
    }

    public function update(Request $request, $item_id)
    {
        $validated = $request->validated();
        $item = Items::findOrFail($item_id);
        if (!$item) {
            return response()->json([
                'success' => false,
                'message' => 'Item not found',
            ], 404);
        }
        $item->update($validated);
        return (new ItemResource($item))->additional([
            'success' => true,
            'message' => 'Item updated successfully',
        ]);
    }

    public function destroy($item_id)
    {
        $item = Items::findOrFail($item_id); // Find the item by its ID
        if (!$item) {
            return response()->json([
                'success' => false,
                'message' => 'Item not found',
            ], 404);
        }
        $item->delete(); // Delete the item from the database
        return response()->json([
            'success' => true,
            'message' => 'Item deleted successfully',
        ]);
    }
}