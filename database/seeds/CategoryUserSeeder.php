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
                $rand_int = random_int(1, 4);
                $randomCategory = $categories->random( $rand_int);
                $user->categories()->attach($randomCategory);
            }
        }
}
