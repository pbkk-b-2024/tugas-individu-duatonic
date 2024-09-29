<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BukuResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'item_id' => $this->item_id,
            'item_name' => $this->item_name,
            'item_category' => $this->item_category,
            'item_price' => $this->item_price,
            'item_quantity' => $this->item_quantity,
            // 'kategori' => KategoriResource::collection($this->kategoris),
        ];
    }
}