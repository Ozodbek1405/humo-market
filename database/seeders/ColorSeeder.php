<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
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
            Color::query()->firstOrCreate(['name' => $item['name']], [
                'name' => $item['name']
            ]);
        }
    }
}
