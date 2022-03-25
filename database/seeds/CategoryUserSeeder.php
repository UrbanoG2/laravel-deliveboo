<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Category;


class CategoryUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // public function run()
    // {
    //     // $categories = Category::all();
    //     $users = User::all();
    //     $category
    //     foreach ($users as $user) {
    //         $user = Category::inRandomOrder()->limit(5)->get();
    //         $user->users()->attach($user);
    //     }
    // }
    public function run()
        {
            $users = User::all();
            $categories = Category::all();
            foreach ($users as $user) {
                $randomCategory = Category::inRandomOrder()->first();
                $user->categories()->attach($randomCategory);
                foreach ($categories as $category) {
                    $rand = random_int(0, 3);
                    if ($rand == 0){
                        if ($randomCategory->id != (int)$category->id) {
                            $user->categories()->attach((int)$category->id);
                        }
                    }
                }
            }
        }
}
