<?php

namespace Database\Seeders;

use App\Models\ProductColor;
use Illuminate\Database\Seeder;

class ProductColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productColors = [
            [
                "name" => "Black"
            ],
            [
                "name" => "White"
            ],
            [
                "name" => "Red"
            ],
            [
                "name" => "Grey"
            ],
            [
                "name" => "Blue"
            ],
            [
                "name" => "Green"
            ],
            [
                "name" => "Yellow"
            ]
        ];

        foreach ($productColors as $item){
            ProductColor::query()->firstOrCreate(['name' => $item['name']], [
                'name' => $item['name']
            ]);
        }
    }
}
