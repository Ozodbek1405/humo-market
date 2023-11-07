<?php

namespace Database\Seeders;

use App\Models\PackagingTypes;
use Illuminate\Database\Seeder;

class PackagingTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $packagingTypes = [
            [
                "type_id" => "4",
                "name" => "СУМКА"
            ],
            [
                "type_id" => "5",
                "name" => "КОНТЕЙНЕР"
            ],
            [
                "type_id" => "6",
                "name" => "КОНВЕРТ"
            ],
            [
                "type_id" => "7",
                "name" => "КОРОБКА"
            ],
            [
                "type_id" => "8",
                "name" => "BTS ПАКЕТИ"
            ],
            [
                "type_id" => "10",
                "name" => "ЗAВОДСКAЯ УПAКОВКA"
            ],
        ];

        foreach ($packagingTypes as $item){
            PackagingTypes::query()->firstOrCreate(['type_id' => $item['type_id']], [
                'type_id' => $item['type_id'],
                'name' => $item['name']
            ]);
        }
    }
}
