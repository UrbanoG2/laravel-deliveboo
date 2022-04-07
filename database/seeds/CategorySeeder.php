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
                'img_category'=> '/images/category/italian.png',
                
                
            ],
            [
                'id' => 2,
                'name' => 'Chinese',
                'img_category'=> '/images/category/chinese.png'
                
            ],
            [
                'id' => 3,
                'name' => 'Fish',
                'img_category'=> '/images/category/seafood.png'
                
            ],
            [
                'id' => 4,
                'name' => 'Vegetarian',
                'img_category'=> '/images/category/healthy.png',
                
            ],
            [
                'id' => 5,
                'name' => 'Indian',
                'img_category'=> '/images/category/indian.png',
                
            ],
            [
                'id' => 6,
                'name' => 'Chicken',
                'img_category'=> '/images/category/american.png',
                
            ],
            [
                'id' => 7,
                'name' => 'Pizza',
                'img_category'=> '/images/category/pizza.png',
                
            ],
            [
                'id' => 8,
                'name' => 'Dessert',
                'img_category'=> '/images/category/japanese.png',
                
            ],
            [
                'id' => 9,
                'name' => 'Burgers',
                'img_category'=> '/images/category/burger.png',
            
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
            $newCategory->img_category = $category['img_category'];
            $newCategory->save();
        }
    }
}
