<?php

namespace Database\Seeders;

use App\Models\SubmissionTypes;
use Illuminate\Database\Seeder;

class SubmissionTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $submissionTypes = [
            [
                "type_id" => "4",
                "name" => "ДОКУМЕНТЫ"
            ],
            [
                "type_id" => "5",
                "name" => "ЗАПЧАСТИ"
            ],
            [
                "type_id" => "6",
                "name" => "МЕДИКАМЕНТЫ"
            ],
            [
                "type_id" => "7",
                "name" => "ОРГТЕХНИКА"
            ],
            [
                "type_id" => "8",
                "name" => "КНИГИ"
            ],
            [
                "type_id" => "9",
                "name" => "СТЕКЛОИЗДЕЛИЯ"
            ],
            [
                "type_id" => "10",
                "name" => "РЕКЛАМНЫЕ ИЗДЕЛИЯ"
            ],
            [
                "type_id" => "11",
                "name" => "ОДЕЖДА-ОБУВИ"
            ],
            [
                "type_id" => "12",
                "name" => "СОТ.ТЕЛЕФОН"
            ],
            [
                "type_id" => "13",
                "name" => "ПАСПОРТ"
            ],
            [
                "type_id" => "14",
                "name" => "ПАРФЮМЕРИЯ"
            ],
            [
                "type_id" => "15",
                "name" => "ПРОДУКТЫ"
            ],[
                "type_id" => "16",
                "name" => "ХИМИКАТЫ"
            ],
            [
                "type_id" => "17",
                "name" => "ПРОТЕЗЫ ( ТИШ )"
            ],
            [
                "type_id" => "18",
                "name" => "СЕМЕНА / УРУГЛАР"
            ],
            [
                "type_id" => "19",
                "name" => "ПЛАСТИК КАРТА"
            ],
            [
                "type_id" => "20",
                "name" => "ПЕЧАТЬ"
            ],
            [
                "type_id" => "21",
                "name" => "САНТЕХНИКА"
            ],
            [
                "type_id" => "22",
                "name" => "МЕБЕЛЬ"
            ],
            [
                "type_id" => "23",
                "name" => "МЕД.ИНСТРУМЕНТ"
            ],
            [
                "type_id" => "24",
                "name" => "ТКАНЬ - МАТЕРИАЛ"
            ],
            [
                "type_id" => "25",
                "name" => "ОБОРУДОВАНИЕ"
            ],
            [
                "type_id" => "26",
                "name" => "КАНЦТОВАРЫ"
            ],
            [
                "type_id" => "27",
                "name" => "ХОЗТОВАРЫ"
            ],
            [
                "type_id" => "28",
                "name" => "ИГРУШКИ"
            ],
            [
                "type_id" => "29",
                "name" => "БИЖУТЕРИЯ"
            ],
            [
                "type_id" => "30",
                "name" => "КОСМЕТИКА"
            ],
            [
                "type_id" => "31",
                "name" => "БЫТОВАЯ ТЕХНИКА"
            ],
            [
                "type_id" => "32",
                "name" => "СУХОФРУКТЫ"
            ],
            [
                "type_id" => "33",
                "name" => "СТРОЙМАТЕРИАЛЫ"
            ],
        ];

        foreach ($submissionTypes as $item) {
            SubmissionTypes::query()->firstOrCreate(['type_id' => $item['type_id']], [
                'type_id' => $item['type_id'],
                'name' => $item['name']
            ]);
        }
    }
}
