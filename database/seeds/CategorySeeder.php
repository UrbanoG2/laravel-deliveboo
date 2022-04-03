<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $restaurantCategory = [

            [
                'id' => 1,
                'name' => 'Italian',
                
                
            ],
            [
                'id' => 2,
                'name' => 'Chinese',
                
                
            ],
            [
                'id' => 4,
                'name' => 'Fish',
                
                
            ],
            [
                'id' => 5,
                'name' => 'Vegetarian',
                
                
            ],
            [
                'id' => 6,
                'name' => 'Indian',
                
                
            ],
            [
                'id' => 7,
                'name' => 'Chicken',
                
                
            ],
            [
                'id' => 8,
                'name' => 'Pizza',
                
                
            ],
            [
                'id' => 9,
                'name' => 'Dessert',
                
                
            ],
            [
                'id' => 10,
                'name' => 'Burgers',
                
            
            ],
        ];
    //     for ($i = 0; $i < 8; $i++) {
    //         $newCategory = new Category();
    //         $newCategory->name = $faker->words(2, true);
    //         $newCategory->save();
    //     }
    // }
     foreach($restaurantCategory as $key=>$category)  {
            $newCategory = new Category();
            $newCategory->name = $category['name'];
            $newCategory->save();
        }
    }
}
