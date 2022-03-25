<?php

use Illuminate\Database\Seeder;

use App\Tag;
class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = ['starter', 'first dish', 'second dish', 'side dish', 'dessert', 'pizza', 'sandwich'];
        foreach ($array as $key => $value) {
            $newTag = new Tag();
            $newTag->name = $value;
            $newTag->save();
        }
    }
}
