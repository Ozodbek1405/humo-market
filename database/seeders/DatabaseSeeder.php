<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RegionSeeder::class,
            DistrictSeeder::class,
            PackagingTypesSeeder::class,
            SubmissionTypesSeeder::class,
            OrderStatusSeeder::class,
            ProductSizeSeeder::class,
            ProductColorSeeder::class,
        ]);
    }
}
