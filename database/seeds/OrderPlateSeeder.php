<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Plate;
use App\Order;

class OrderPlateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // $plates = Plate::all();
        $orders = Order::all();
        foreach ($orders as $order) {
            $randomPlates = Plate::inRandomOrder()->limit(5)->get();
            foreach ($randomPlates as $plate) {
                $randomQuantity = $faker->numberBetween(1,10);
                $order->plates()->attach($plate, ['quantity'=> $randomQuantity]);
            }
        }


        // $orders = Order::all();
        // foreach ($orders as $order) {
        //     $randNumOfPlate = rand(1, 5);
        //     $plates = Plate::where($order->id);

        //     foreach ($artistOf as $who) {
        //         $comic->artist()->attach($who);
        //     }
        // }
    }
}
