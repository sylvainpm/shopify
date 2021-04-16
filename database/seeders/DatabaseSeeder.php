<?php

namespace Database\Seeders;

use App\Models\Produit;
use Illuminate\Database\Seeder;
use Database\Seeders\ProduitSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     *
     */
    public function run()
    {

        $this->call([ProduitSeeder::class]);


       //o peut commenter ça maintenent         Produit::factory(50)->create() ;
        // si on fait use App\Models\Produit comme la ligne 5 vaut mieux garder la ligne 28;   \App\Models\Produit::factory(50)->create() ;
        \App\Models\User::factory(10)->create();






        $this->call([
            CategorySeeder::class,

                      ]) ;
    }
}
