<?php

use Illuminate\Database\Seeder;
use App\Models\News;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        News::truncate();

        foreach (range(1, 20) as $index) {
            News::create([
                'title' => $faker->sentence,
        'intro' => $faker->paragraph(1),
                'description' => $faker->paragraph(3),
                'image_path' => $faker->imageUrl(150, 150),
            ]);
        };
    }
}
