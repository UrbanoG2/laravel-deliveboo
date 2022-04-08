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
        $array = ['antipasti', 'primi piatti', 'secondi piatti', 'contorni', 'dolci', 'pizza', 'panini', 'sushi', 'vegetariano', 'bevande', 'vini'];
        foreach ($array as $key => $value) {
            $newTag = new Tag();
            $newTag->name = $value;
            $newTag->save();
        }
    }
}
