<?php

namespace Database\Seeders;

use App\Models\category;
use App\Models\Produit;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    //appeler notre CategoryFactory ici
    category::factory(10)->has(Produit::factory(50))->create();
    }
}
