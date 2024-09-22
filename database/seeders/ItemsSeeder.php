<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Items;

class ItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'name' => 'Item 1',
                'price' => 100,
                'quantity' => 10,
                'category' => 'Category 1',
            ],
            [
                'name' => 'Item 2',
                'price' => 200,
                'quantity' => 20,
                'category' => 'Category 2',
            ],
            [
                'name' => 'Item 3',
                'price' => 300,
                'quantity' => 30,
                'category' => 'Category 3',
            ],
        ];

        foreach ($items as $item) {
            Items::create($item);
        }
    }
}