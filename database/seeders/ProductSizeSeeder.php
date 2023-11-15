<?php

namespace Database\Seeders;

use App\Models\ProductSize;
use Illuminate\Database\Seeder;

class ProductSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productSizes = [
            [
                "name" => "XXS"
            ],
            [
                "name" => "XS"
            ],
            [
                "name" => "XS-S"
            ],
            [
                "name" => "S"
            ],
            [
                "name" => "M"
            ],
            [
                "name" => "M-L"
            ],
            [
                "name" => "L"
            ],
            [
                "name" => "XL"
            ]
        ];

        foreach ($productSizes as $item){
            ProductSize::query()->firstOrCreate(['name' => $item['name']], [
                'name' => $item['name']
            ]);
        }
    }
}
