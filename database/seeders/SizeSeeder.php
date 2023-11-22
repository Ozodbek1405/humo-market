<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
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
            Size::query()->firstOrCreate(['name' => $item['name']], [
                'name' => $item['name']
            ]);
        }
    }
}
