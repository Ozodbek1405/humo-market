<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $packagingTypes = [
            [
                "type_id" => "0",
                "name" => "Отказ"
            ],
            [
                "type_id" => "1",
                "name" => "У отправителя"
            ],
            [
                "type_id" => "2",
                "name" => "Курьер принял"
            ],
            [
                "type_id" => "3",
                "name" => "В офисе отправления"
            ],
            [
                "type_id" => "4",
                "name" => "В офисе доставки"
            ],
            [
                "type_id" => "5",
                "name" => "Курьер доставляет"
            ],
            [
                "type_id" => "6",
                "name" => "Доставлен"
            ],
            [
                "type_id" => "7",
                "name" => "Возврат"
            ],
            [
                "type_id" => "8",
                "name" => "В промежуточном офисе"
            ],
            [
                "type_id" => "31",
                "name" => "На складе"
            ],
            [
                "type_id" => "32",
                "name" => "В мешке"
            ],
            [
                "type_id" => "33",
                "name" => "В перевозке"
            ],
            [
                "type_id" => "34",
                "name" => "В РЦ Курьера"
            ],
        ];

        foreach ($packagingTypes as $item){
            OrderStatus::query()->firstOrCreate(['type_id' => $item['type_id']], [
                'type_id' => $item['type_id'],
                'name' => $item['name']
            ]);
        }
    }

}
