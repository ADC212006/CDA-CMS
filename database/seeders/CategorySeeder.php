<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Number of records to seed
        $numberOfRecords = 1000000;

        foreach (range(1, $numberOfRecords) as $index) {
            Category::create([
                'category_name' => $faker->word,
                'description' => $faker->sentence,
                'file' => $faker->imageUrl(640, 480, 'business', true) // Generating a fake image URL
            ]);
        }
    }
}
