<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\State;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        $array = ['pending', 'processing', 'preparation'];
        foreach ($array as $key => $value) {

            $newstate = new State();
            $newstate->name = $value;
            $newstate->save();
        }
    }
}
