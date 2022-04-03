<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Expr\New_;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        $newUser = new User();
        $newUser->name = 'Admin';
        $newUser->slug = Str::slug($newUser->name . '-' . 666, '-');
        $newUser->email = 'Admin@admin.it';
        $string = '12345678';
        $newUser->password = Hash::make($string);
        $newUser->address = $faker->address();
        $newUser->iva = $faker->numerify('###########');
        $newUser->logo_img = $faker->imageUrl(640, 480, 'logo', true);
        $newUser->banner_img = $faker->imageUrl(640, 480, 'banner', true);
        $newUser->save();

        $restaurantList = [
            [
            'name' => 'La Taverna',
            'email' => 'taverna@email.it',
            'password' =>'123456',
            'address' => 'Via Garibaldi, 13',
            'iva' => '60028970626',
            'logo_img' => 'img/restaurant/la-taverna.jpg',
            'banner_img' => 'img/restaurant/la-taverna.jpg',
            ],
            [
            'name' => 'Margherita',
            'email' => 'margherita@email.it',
            'password' =>'123456' ,
            'address' => 'Via della Posta , 89',
            'iva' => '60028970626',
            'logo_img' => 'img/restaurant/margherita.jpg',
            'banner_img' => 'img/restaurant/la-taverna.jpg',
            ],
            [
            'name' => 'Il Chiostro',
            'email' => 'ilchiostro@email.it',
            'password' =>'123456' ,
            'address' => 'Via del Municipio antico , 6',
            'iva' => '27178340389',
            'logo_img' => 'img/restaurant/il-chiostro.jpg',
            'banner_img' => 'img/restaurant/la-taverna.jpg',
            ],
            [
            'name' => 'Due Passi',
            'email' => 'duepassi@email.it',
            'password' =>'123456' ,
            'address' => 'Via della Speranza , 66',
            'iva' => '68207150167',
            'logo_img' => 'img/restaurant/due-passi.jpg',
            'banner_img' => 'img/restaurant/la-taverna.jpg',
            ],
            [
            'name' => 'Itsu',
            'email' => 'itsu@email.it',
            'password' =>'123456' ,
            'address' => 'Via Alfredo Renzi , 3',
            'iva' => '47769490088',
            'logo_img' => 'img/restaurant/itsu.jpg',
            'banner_img' => 'img/restaurant/la-taverna.jpg',
            ],
            [
            'name' => 'The Burger',
            'email' => 'theburger@emial.it',
            'password' =>'123456' ,
            'address' => '	Via della Luna , 4',
            'iva' => '47769490088',
            'logo_img' => 'img/restaurant/the-burger.jpg',
            'banner_img' => 'img/restaurant/la-taverna.jpg',
            ],
            [
            'name' => 'Alla Griglia',
            'email' => 'allagriglia@email.it',
            'password' =>'123456' ,
            'address' => 'Via del Domicilio , 3',
            'iva' => '47769490088',
            'logo_img' => 'img/restaurant/alla-griglia.jpg',
            'banner_img' => 'img/restaurant/la-taverna.jpg',
            ],
            [
                'name' => 'Mi Scusi',
                'email' => 'miscusi@email.it',
                'password' =>'123456' ,
                'address' => 'Via XVII ottobre , 23',
                'iva' => '47769490088',
                'logo_img' => 'img/restaurant/mi-scusi.jpg',
                'banner_img' => 'img/restaurant/la-taverna.jpg',
            ],
            [
                'name' => 'Be Green',
                'email' => 'begreen@email.it',
                'password' =>'123456', 
                'address' => 'Via Agostino , 23',
                'iva' => '47769490088',
                'logo_img' => 'img/restaurant/be-green.jpg',
                'banner_img' => 'img/restaurant/la-taverna.jpg',
            ],
            [
                'name' => 'Zero',
                'email' => 'zero@email.it',
                'password' =>'123456', 
                'address' => 'Via Passatempo , 11',
                'iva' => '47769490088',
                'logo_img' => 'img/restaurant/zero.jpg',
                'banner_img' => 'img/restaurant/la-taverna.jpg',
            ],
        ];
        foreach($restaurantList as $key=>$user) 
        {
            $newUser = new User();
            $newUser->name = $user['name'];
            $newUser->slug = Str::slug($newUser->name . '-' . $key, '-');
            $newUser->email = $user['email'];
            $string = '12345678';
            $newUser->password = Hash::make($string);
            $newUser->address = $user['address'];
            $newUser->iva = $user['iva'];
            $newUser->logo_img = $user['logo_img'];
            $newUser->banner_img = $user['banner_img'];
            $newUser->save();
        }
    }
}
