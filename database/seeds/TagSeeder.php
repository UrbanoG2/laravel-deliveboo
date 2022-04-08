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
        $array = ['Antipasti', 'Primi Piatti', 'Secondi Piatti', 'Contorni', 'Dessert', 'Pizza', 'Sandwich'];
        foreach ($array as $key => $value) {
            $newTag = new Tag();
            $newTag->name = $value;
            $newTag->save();
        }
    }
}
