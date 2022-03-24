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
    public function run()
    {
        $categories = Category::all();
        foreach ($categories as $category) {
            $users = User::inRandomOrder()->limit(5)->get();
            $category->users()->attach($users);
        }
    }
}
