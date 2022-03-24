<?php

use Illuminate\Database\Seeder;
use App\Plate;
use App\Order;

class OrderPlateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plates = Plate::where();
        foreach ($plates as $plate) {
            $orders = Order::inRandomOrder()->limit(5)->get();
            $plate->orders()->attach($orders);
        }


        $orders = Order::all();
        foreach ($orders as $order) {
            $randNumOfPlate = rand(1, 5);
            $plates = Plate::where($order->id);

            foreach ($artistOf as $who) {
                $comic->artist()->attach($who);
            }
        }
    }
}
