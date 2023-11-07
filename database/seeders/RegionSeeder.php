<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regions = [
            [
                'region_id' =>  '2',
                'name' => "Андижанская область"
            ],
            [
                'region_id' =>  '3',
                'name' => "Наманганская область"
            ],
            [
                'region_id' =>  '4',
                'name' => "Хорезмская область"
            ],
            [
                'region_id' =>  '5',
                'name' => "Ташкентская область"
            ],
            [
                'region_id' =>  '6',
                'name' => "Ташкент"
            ],
            [
                'region_id' =>  '7',
                'name' => "Бухарская область"
            ],
            [
                'region_id' =>  '8',
                'name' => "Самаркандская область"
            ],
            [
                'region_id' =>  '9',
                'name' => "Джизакская область"
            ],
            [
                'region_id' =>  "10",
                'name' => "Навоийская область"
            ],
            [
                'region_id' =>  "11",
                'name' => "Каракалпакстан"
            ],
            [
                'region_id' =>  "12",
                'name' => "Сырдарьинская область"
            ],
            [
                'region_id' =>  "13",
                'name' => "Сурхандарьинская область"
            ],
            [
                'region_id' =>  "14",
                'name' => "Кашкадарьинская область"
            ],
            [
                'region_id' =>  "15",
                'name' => "Ферганская область"
            ],
        ];

        foreach ($regions as $item) {
            Region::query()->firstOrCreate(['region_id' => $item['region_id']], [
                'region_id' => $item['region_id'],
                'name' => $item['name']
            ]);
        }
    }
}
