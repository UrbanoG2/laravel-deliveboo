<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Plate;


class PlateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 5; $i++) {
            for ($x = 0; $x < 5; $x++) { 
                $newPlate = new Plate();
                $newPlate->user_id = $i + 1;
                $newPlate->tag_id = $faker->numberBetween(1, 7);
                $newPlate->name = $faker->words(2, true);
                $newPlate->description = $faker->paragraph(5, true);
                $newPlate->price = $faker->randomFloat(null, 0, 1000);
                $newPlate->ingredients = $faker->paragraph(3, true);
                $newPlate->visible = $faker->boolean();
                $newPlate->preview = $faker->imageUrl(640, 480, 'food', true);
                $newPlate->save();
            }
        }
    }
}
