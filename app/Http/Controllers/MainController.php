<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Produit;
use App\Models\category;
use Illuminate\Http\Request;
use App\Exports\ProduitsExport;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class MainController extends Controller
{
    //

    public function accueil()

    {
        $produits = Produit::orderByDesc("id")->take(9)->get() ;
        return view("welcome", [
        "produits"=>$produits
        ]);
    }

    public function ajouterProduit()
            {
               // dd("hello");
              $produit= Produit::create([
                    "designation"=>"Cahier",

                    "description"=>"La description du Cahier",
                    "prix"=> 500


               ]) ;
               dd($produit) ;





            }





            public function updateProduitinitial()
            {

                $produit = Produit::first();
                dump($produit) ;
                $produit->designation = "Chemise" ;
                $produit->description = "La description de Chemise" ;
                $produit->prix = 7000 ;
                $produit->save();
                dd($produit) ;
            }



            public function updateProduit($id)
            {

                $produit = Produit::findOrFail($id);
               // dump($produit) ;
                $produit->designation = "Chemise" ;
                $produit->description = "La description de Chemise" ;
                $produit->prix = 7000 ;
                $produit->save();
                dd($produit) ;
            }







            public function updateProduit2()
            {

              //  $produit = Produit::findOrFail(2);


               // dd($produit) ;
                $result = Produit::where("id", 2)->update([
                        "designation" => "Tricot" ,
                        "description" => "La description de Tricot" ,
                        "prix" => 3500



                ]) ;
                dd($result) ;
            }


                    //mise à jour avec paramètre
            public function updateProduit3($id)
            {

              //  $produit = Produit::findOrFail(2);


               // dd($produit) ;
                $result = Produit::where("id", $id)->update([
                        "designation" => "Tricot" ,
                        "description" => "La description de Tricot" ,
                        "prix" => 3500



                ]) ;
                dd($result) ;
            }



            public function supprimerProduit()
            {

             $result = Produit::destroy(1) ;
             dd($result) ;
            }



            //suppression avec paramètre
            public function supprimerProduit2(int $id)
            {

             $result = Produit::destroy($id) ;
             dd($result) ;
            }


            public function createCategory()
            {

                $category = category::create([

                    "libelle"=>"Vetements",


                ]) ;



                $produit= Produit::create([
                    "category_id"=>$category->id,

                    "designation"=>"Pantalon",
                    "description"=>"La description du Pantalon",
                    "prix"=> 5000


               ]) ;
               dd($produit) ;





            }

            public function getProduit(Produit $produit)
            {
                # code...
               // dd($produit) ;
               $category = Category::first() ;
               dd($category , $category->produits) ;
              //  dd($produit->category) ;

            }


            public function commande()
            {
    //            $user = User::create([
    //                "name" => "Issa OUEDRAOGO" ,
    //               "email" => "issa@gmail.com" ,
    //               "password" => Hash::make("admin123"),


    //           ]);

     $user = User::first() ;

                $produit1 = Produit::first() ;

                //prendre le deuxième produit
                $produit2 = Produit::findOrFail(2) ;

               // le id n'est pas obligatoire $user->produits()->attach($produit1->id()) ;

     //           $user->produits()->attach($produit1) ;
     //           dd($user);


   //on peut utiliser sync au lieu de attach         $user->produits()->attach($produit2) ;

     //       $user->produits()->sync($produit1) ;
            $user->produits()->attach($produit2) ;

     dd($user->produits);




            }

            public function collection()
            {
                $collection1 = collect([


                  collect ( [

                        "title"=>"Mon Super livre 1" ,
                        "price"=>5000 ,
                        "description"=>"La description du livre  " ,
                    ]) ,

                    collect ( [

                        "title"=>"Mon Super livre 2" ,
                        "price"=>7000 ,
                        "description"=>"La description du livre 2 " ,
                    ]) ,

                    collect ( [

                        "title"=>"Mon Super livre 3" ,
                        "price"=>12000 ,
                        "description"=>"La description du livre 3 " ,
                    ]) ,

                ]) ;
                $collection1->push([

                    "title"=>"Mon Super livre 4" ,
                    "price"=>147000 ,
                    "description"=>"La description du livre 4 " ,


                ]) ;
               // dd($collection1);
               // dd($collection1->where("price", ">" ,"5000"));
                //dd($collection1->where("price", ">" 5000));

            //     dd($collection1);

             //    dd($collection1->sortByDesc('price'));

             $nouvellecollection = $collection1->filter(function($livre , $key)
                 {
                    return $livre["price"] >= 10000 ;

                 }) ;

                dd($nouvellecollection) ;


            }



            public function exportProduits()
            {
              return Excel::download(new ProduitsExport, 'produits.xlsx');
            }






}
