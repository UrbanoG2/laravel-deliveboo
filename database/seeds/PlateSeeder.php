<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Plate;


class PlateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $plates = [
            [
                'user_id' => 1,
                'tag_id' => 1,
                'name' => 'Marinara',
                'description' => "Pomodoro S.Marzano, aglio, origano, basilico, olio Evo",
                'price' => '6',
                'ingredients' =>"Pomodoro S.Marzano, aglio, origano, basilico, olio Evo",
                'visible' => true,
                'preview' => '/images/restaurant/pizza-marinara.jpg',    /*    /images/restaurant/pizza-marinara.jpg    */
            ],
            [
                'user_id' => 1,
                'tag_id' => 2,
                'name' => 'Margherita',
                'description' => "Pomodoro S.Marzano, Fior di Latte, basilico, olio Evo",
                'price' => '6',
                'ingredients' => "Pomodoro S.Marzano, Fior di Latte, basilico, olio Evo",
                'visible' => true,
                'preview' => '/images/restaurant/pizza-margherita.jpg',
            ],
            [
                'user_id' => 1,
                'tag_id' => 1,
                'name' => 'Americana',
                'description' => "Pomodoro S.Marzano, Fior di Latte, Patatine, basilico, olio Evo",
                'price' => '8',
                'ingredients' =>"Pomodoro S.Marzano, Fior di Latte, Patatine, basilico, olio Evo",
                'visible' => true,
                'preview' => '/images/restaurant/pizza-americana.jpg',
            ],
            [
                'user_id' => 1,
                'tag_id' => 1,
                'name' => 'Napoli',
                'description' => "Pomodoro S.Marzano DOP, Fior di Latte, Olive di Gaeta, Acciughe di Sciacca",
                'price' => '8',
                'ingredients' =>"Pomodoro S.Marzano DOP, Fior di Latte, Olive di Gaeta, Acciughe di Sciacca",
                'visible' => true,
                'preview' => '/images/restaurant/pizza-napoli.jpg',
            ],
            [
                'user_id' => 1,
                'tag_id' => 1,
                'name' => 'Bufalina',
                'description' => "Pomodoro S.Marzano DOP, Bufala Campana DOP, basilico, olio Evo",
                'price' => '8',
                'ingredients' =>"Pomodoro S.Marzano DOP, Bufala Campana DOP, basilico, olio Evo",
                'visible' => true,
                'preview' => '/images/restaurant/pizza-Bufala.jpg',
            ],
            [
                'user_id' => 1,
                'tag_id' => 1,
                'name' => 'Carbonara',
                'description' => "Spaghetti,Guanciale, Tuorlo d'Uovo, Pecorino romano DOP",
                'price' => '10',
                'ingredients' =>"Spaghetti,Guanciale, Tuorlo d'Uovo, Pecorino romano DOP",
                'visible' => true,
                'preview' => '/images/restaurant/carbonara.jpg',
            ],
            [
                'user_id' => 1,
                'tag_id' => 1,
                'name' => 'Amatriciana',
                'description' => "Spaghetti,Guanciale, Pomodoro, Pecorino romano DOP",
                'price' => '10',
                'ingredients' =>"Spaghetti,Guanciale, Pomodoro, Pecorino romano DOP",
                'visible' => true,
                'preview' => '/images/restaurant/amatriciana.jpg',
            ],
            [
                'user_id' => 1,
                'tag_id' => 1,
                'name' => 'Cacio e Pepe',
                'description' => "Spaghetti,Pecorino romano DOP, Pepe",
                'price' => '10',
                'ingredients' =>"Spaghetti,Pecorino romano DOP, Pepe",
                'visible' => true,
                'preview' => '/images/restaurant/cacio-e-pepe.jpg',
            ],
            [
                'user_id' => 2,
                'tag_id' => 1,
                'name' => 'Salmone al pepe Rosa',
                'description' => "Trancio di salmone di Alaska, prezzemolo, olio Extra Vergine, Pepe Rosa",
                'price' => '12',
                'ingredients' =>"Trancio di salmone di Alaska, prezzemolo, olio Extra Vergine, Pepe Rosa",
                'visible' => true,
                'preview' => '/images/restaurant/salmone-al-pepe-rosa.jpg',
            ],
            [
                'user_id' => 2,
                'tag_id' => 1,
                'name' => 'Tartare di Tonno',
                'description' => "Tartare di Tonno abbattuto, olio Evo, semi di papavero",
                'price' => '13',
                'ingredients' =>"Tartare di Tonno abbattuto, olio Evo, semi di papavero",
                'visible' => true,
                'preview' => '/images/restaurant/tartare-di-tonno.jpg',
            ],
            [
                'user_id' => 2,
                'tag_id' => 1,
                'name' => 'Scaloppine di Pollo al Limone',
                'description' => "Fettine di pollo marinate al limone, olio, prezzemolo",
                'price' => '13',
                'ingredients' =>"Fettine di pollo marinate al limone, olio, prezzemolo",
                'visible' => true,
                'preview' => '/images/restaurant/scaloppine-di-pollo-al-limone.jpg',
            ],
            [
                'user_id' => 2,
                'tag_id' => 1,
                'name' => 'Petti di Tacchino alla Bolognese',
                'description' => "Tacchino, Prosciutto crudo, Parmigiano Reggiano DOP, Marsala, Tartufo Nero",
                'price' => '14',
                'ingredients' =>"Tacchino, Prosciutto crudo, Parmigiano Reggiano DOP, Marsala, Tartufo Nero",
                'visible' => true,
                'preview' => '/images/restaurant/petti-di-tacchino-alla-bolognese.jpg',
            ],
            [
                'user_id' => 2,
                'tag_id' => 1,
                'name' => 'Patatine Fritte',
                'description' => "Patatine, Sale",
                'price' => '4',
                'ingredients' =>"Patatine, Sale",
                'visible' => true,
                'preview' => '/images/restaurant/patatine-fritte.jpg',
            ],
            [
                'user_id' => 2,
                'tag_id' => 1,
                'name' => 'Verdure Grigliate',
                'description' => "Zucchine, Melanzane, Zucca, Peperoni, Olio, Sale, Prezzemolo",
                'price' => '5',
                'ingredients' =>"Zucchine, Melanzane, Zucca, Peperoni, Olio, Sale, Prezzemolo",
                'visible' => true,
                'preview' => '/images/restaurant/verdure-grigliate.jpg',
            ],
            [
                'user_id' => 2,
                'tag_id' => 1,
                'name' => 'Patate al Forno',
                'description' => "Patate, Rosmarino, Olio, Sale",
                'price' => '5',
                'ingredients' =>"Patate, Rosmarino, Olio, Sale",
                'visible' => true,
                'preview' => '/images/restaurant/patate-al-forno.webp',
            ],
            [
                'user_id' => 3,
                'tag_id' => 1,
                'name' => 'Petti di Tacchino alla Bolognese',
                'description' => "Tacchino, Prosciutto crudo, Parmigiano Reggiano DOP, Marsala, Tartufo Nero",
                'price' => '14',
                'ingredients' =>"Tacchino, Prosciutto crudo, Parmigiano Reggiano DOP, Marsala, Tartufo Nero",
                'visible' => true,
                'preview' => '/images/restaurant/petti-di-tacchino-alla-bolognese2.jpg',
            ],
            [
                'user_id' => 3,
                'tag_id' => 1,
                'name' => 'Classico',
                'description' => "Pane al Sesamo, Hamburger di Fassona 320g, Insalata, Pomodoro, *salse",
                'price' => '6',
                'ingredients' =>"Pane al Sesamo, Hamburger di Fassona 320g, Insalata, Pomodoro, *salse",
                'visible' => true,
                'preview' => '/images/restaurant/humburger-di-fassona.jpg',
            ],
            [
                'user_id' => 3,
                'tag_id' => 1,
                'name' => 'ChickenBurger',
                'description' => "Pane al Sesamo, Petto di Pollo impanato, Insalata, Pomodoro, *salse",
                'price' => '6',
                'ingredients' =>"Pane al Sesamo, Petto di Pollo impanato, Insalata, Pomodoro, *salse",
                'visible' => true,
                'preview' => '/images/restaurant/chickenburger.jpg',
            ],
            [
                'user_id' => 3,
                'tag_id' => 1,
                'name' => 'BaconBurger',
                'description' => "Pane al Sesamo, Hamburger di Maiale, Formaggio, Bacon, *salse",
                'price' => '6',
                'ingredients' =>"Pane al Sesamo, Hamburger di Maiale, Formaggio, Bacon, *salse",
                'visible' => true,
                'preview' => '/images/restaurant/burger2.jpg',
            ],
            [
                'user_id' => 4,
                'tag_id' => 1,
                'name' => 'Marinara',
                'description' => "Spaghetti sugo di mare, aglio, origano, basilico, olio Evo",
                'price' => '6',
                'ingredients' =>"Spaghetti sugo di mare, aglio, origano, basilico, olio Evo",
                'visible' => true,
                'preview' => '/images/restaurant/spaghetti-marinara.jpg',
            ],
            [
                'user_id' => 4,
                'tag_id' => 1,
                'name' => 'Samosa',
                'description' => "Triangolo fritto, ripieno di verdure ",
                'price' => '6',
                'ingredients' =>"Triangolo fritto, ripieno di verdure ",
                'visible' => true,
                'preview' => '/images/restaurant/samosa.jpg',
            ],
            [
                'user_id' => 4,
                'tag_id' => 1,
                'name' => 'Naan',
                'description' => "Pane cotto nel Tandoor (il tipico forno d???argilla)",
                'price' => '8',
                'ingredients' =>"Pane cotto nel Tandoor (il tipico forno d???argilla)",
                'visible' => true,
                'preview' => '/images/restaurant/naan.jpg',
            ],
            [
                'user_id' => 4,
                'tag_id' => 1,
                'name' => 'Pollo Tandoori',
                'description' => "Coscie marinare nello yogurt e altre spezie ",
                'price' => '8',
                'ingredients' =>"Coscie marinare nello yogurt e altre spezie ",
                'visible' => true,
                'preview' => '/images/restaurant/pollo-tandoori.jpg',
            ],
            [
                'user_id' => 4,
                'tag_id' => 1,
                'name' => 'Hamburger di ceci',
                'description' => "Pane al Sesamo, Hamburger di Ceci, Formaggio, Bacon, *salse",
                'price' => '8',
                'ingredients' =>"Pane al Sesamo, Hamburger di Ceci, Formaggio, Bacon, *salse",
                'visible' => true,
                'preview' => '/images/restaurant/hamburger-di-ceci.jpg',
            ],
            [
                'user_id' => 4,
                'tag_id' => 1,
                'name' => 'Focaccia',
                'description' => "Focaccia, Sale, Olio, ingredienti a scelta",
                'price' => '5',
                'ingredients' =>"Focaccia, Sale, Olio, ingredienti a scelta",
                'visible' => true,
                'preview' => '/images/restaurant/focaccia.png',
            ],
            [
                'user_id' => 5,
                'tag_id' => 1,
                'name' => 'Temaki Roll',
                'description' => "Salmone, Riso, Avocado, Philadelphia, Alga Nori, Maionese",
                'price' => '5',
                'ingredients' =>"Salmone, Riso, Avocado, Philadelphia, Alga Nori, Maionese",
                'visible' => true,
                'preview' => '/images/restaurant/temaki-roll.jpg',
            ],
            [
                'user_id' => 5,
                'tag_id' => 1,
                'name' => 'Sashimi',
                'description' => "Salmone o Tonno fresco abbattuto con Salsa di Soia agli Agrumi",
                'price' => '12',
                'ingredients' =>"Salmone o Tonno fresco abbattuto con Salsa di Soia agli Agrumi",
                'visible' => true,
                'preview' => '/images/restaurant/sashimi.jpg',
            ],
            [
                'user_id' => 5,
                'tag_id' => 1,
                'name' => 'Uramaki Roll',
                'description' => "Roll di Riso con Salmone, Tonno o Gamberi, Avocado",
                'price' => '8',
                'ingredients' =>"Roll di Riso con Salmone, Tonno o Gamberi, Avocado",
                'visible' => true,
                'preview' => '/images/restaurant/uramaki-roll.jpg',
            ],
            [
                'user_id' => 6,
                'tag_id' => 1,
                'name' => 'Churrasco',
                'description' => "Carne di Vitello e Maiale alla brace con verdure",
                'price' => '10',
                'ingredients' =>"Carne di Vitello e Maiale alla brace con verdure",
                'visible' => true,
                'preview' => '/images/restaurant/churrasco.jpg',
            ],
            [
                'user_id' => 6,
                'tag_id' => 1,
                'name' => 'Barbecue',
                'description' => "Grigliata di carne mista",
                'price' => '10',
                'ingredients' =>"Grigliata di carne mista",
                'visible' => true,
                'preview' => '/images/restaurant/barbecue.jpg',
            ],
            [
                'user_id' => 7,
                'tag_id' => 1,
                'name' => 'Sacher Torte',
                'description' => "Torta Sacher farcita con marmellata alle pesche, ricoperta di cioccolato fondente",
                'price' => '16',
                'ingredients' =>"Torta Sacher farcita con marmellata alle pesche, ricoperta di cioccolato fondente",
                'visible' => true,
                'preview' => '/images/restaurant/sacher-torte.jpg',
            ],
            [
                'user_id' => 8,
                'tag_id' => 1,
                'name' => 'Spaghetti al pesto di Rucola',
                'description' => "Spaghetti integrali, pesto di rucola, olio, mandorle",
                'price' => '7',
                'ingredients' =>"Spaghetti integrali, pesto di rucola, olio, mandorle",
                'visible' => true,
                'preview' => '/images/restaurant/spaghetti-al-pesto-di-rucola.jpg',
            ],
            [
                'user_id' => 8,
                'tag_id' => 1,
                'name' => 'Involtini di Melanzane al forno',
                'description' => "Involtini di Melanzane con Pomodoro e Zucca",
                'price' => '8',
                'ingredients' =>"Involtini di Melanzane con Pomodoro e Zucca",
                'visible' => true,
                'preview' => '/images/restaurant/involtini-di-melanzane-al-forno.jpg',
            ],
            [
                'user_id' => 9,
                'tag_id' => 1,
                'name' => 'Fritto Misto',
                'description' => "Fritto misto di mare",
                'price' => '6',
                'ingredients' =>"Fritto misto di mare",
                'visible' => true,
                'preview' => '/images/restaurant/frittura-di-mare.jpg',
            ],
            [
                'user_id' => 10,
                'tag_id' => 1,
                'name' => 'Classico',
                'description' => "Pane al Sesamo, Hamburger di Fassona 320g, Insalata, Pomodoro, *salse",
                'price' => '6',
                'ingredients' =>"Pane al Sesamo, Hamburger di Fassona 320g, Insalata, Pomodoro, *salse",
                'visible' => true,
                'preview' => '/images/restaurant/humburger.jpeg',
            ],
            [
                'user_id' => 10,
                'tag_id' => 1,
                'name' => 'Pancakes',
                'description' => "Pancakes americani con frutta e cioccolato",
                'price' => '6',
                'ingredients' =>"Pancakes americani con frutta e cioccolato",
                'visible' => true,
                'preview' => '/images/restaurant/pancakes.jpg',
            ],
            [
                'user_id' => 10,
                'tag_id' => 1,
                'name' => 'Torta Mimosa',
                'description' => "Soffice pan di spagna aromatizzato al limone",
                'price' => '10',
                'ingredients' =>"Soffice pan di spagna aromatizzato al limone",
                'visible' => true,
                'preview' => '/images/restaurant/torta-mimosa.jpg',
            ],
            [
                'user_id' => 10,
                'tag_id' => 1,
                'name' => 'Torta al cioccolato',
                'description' => "Torta a tre diversi tipi di cioccolato",
                'price' => '10',
                'ingredients' =>"Torta a tre diversi tipi di cioccolato",
                'visible' => true,
                'preview' => '/images/restaurant/torta-al-cioccolato.jpg',
            ],
            [
                'user_id' => 11,
                'tag_id' => 1,
                'name' => 'Marinara',
                'description' => "Pomodoro S.Marzano, aglio, origano, basilico, olio Evo",
                'price' => '6',
                'ingredients' =>"Pomodoro S.Marzano, aglio, origano, basilico, olio Evo",
                'visible' => true,
                'preview' => '/images/restaurant/pizza-marinara.jpg',    
            ],
            [
                'user_id' => 11,
                'tag_id' => 2,
                'name' => 'Margherita',
                'description' => "Pomodoro S.Marzano, Fior di Latte, basilico, olio Evo",
                'price' => '6',
                'ingredients' => "Pomodoro S.Marzano, Fior di Latte, basilico, olio Evo",
                'visible' => true,
                'preview' => '/images/restaurant/pizza-margherita.jpg',
            ],
            [
                'user_id' => 11,
                'tag_id' => 1,
                'name' => 'Americana',
                'description' => "Pomodoro S.Marzano, Fior di Latte, Patatine, basilico, olio Evo",
                'price' => '8',
                'ingredients' =>"Pomodoro S.Marzano, Fior di Latte, Patatine, basilico, olio Evo",
                'visible' => true,
                'preview' => '/images/restaurant/pizza-americana.jpg',
            ],
        ];

        foreach($plates as $key=>$plate) 
        {
            $newPlate = new Plate();
            $newPlate->name = $plate['name'];
            $newPlate->slug = Str::slug($newPlate->name . '-' . $key, '-');
            $newPlate->user_id = $plate['user_id'];
            $newPlate->tag_id = $plate['tag_id'];
            $newPlate->description = $plate['description'];
            $newPlate->price = $plate['price'];
            $newPlate->ingredients = $plate['ingredients'];
            $newPlate->visible = $faker->boolean();
            $newPlate->preview = $plate['preview'];
            $newPlate->save();
        }

        // for ($i = 0; $i < 1; $i++) {
        //     for ($x = 0; $x < 5; $x++) {
        //         $newPlate = new Plate();
        //         $newPlate->user_id = $i + 1;
        //         $newPlate->tag_id = $faker->numberBetween(1, 7);
        //         $newPlate->name = $faker->words(2, true);
        //         $newPlate->slug = Str::slug($newPlate->name . '-' . $i, '-');
        //         $newPlate->description = $faker->paragraph(5, true);
        //         $newPlate->price = $faker->randomFloat(null, 0, 1000);
        //         $newPlate->ingredients = $faker->paragraph(3, true);
        //         $newPlate->visible = $faker->boolean();
        //         $newPlate->preview = $faker->imageUrl(640, 480, 'food', true);
        //         $newPlate->save();
        //     }
        // }
    }
}
