<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Order;
use App\User;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $users = User::all();
        foreach ($users as $key => $user) {
            $rand = random_int(1, 15);
            for ($i = 0; $i < $rand; $i++) {
                $newOrder = new Order();
                $newOrder->totalPrice = $faker->randomFloat(null, 20, 200);
                $newOrder->state_id = 1;
                $newOrder->save();
            }
        }
    }
}
