<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Produit;
use App\Models\category;
use App\Mail\ProduitAjoute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Database\Factories\ProduitFactory;
use App\Http\Requests\ProduitFormRequest;
use App\Notifications\ModificationProduit;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
  //au lieu de all nous allons utiliser paginate     $produits = Produit::all() ;

       $produits = Produit::orderByDesc('id')->paginate(15) ;

     //  $produits500 = Produit::where(["prix"=>500 , "designation"=>"Cahier"])->get();
                      // 1 $premier = Produit::first() ;
      // $produit = Produit::find(20);
    // 1 dd($premier) ;
      // dd($produit) ;
      // dd($produits500);
      // dd($produits) ;
       //dump($produits) ;

        return view("front-office.produits.index" , [
            "produits" => $produits
        ]) ;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //


            $categories = category::all() ;
            $produit = new Produit ;
        // pour éviter l'erreur $produit undifined qu'on crée la ligne 51    $produit = new Produit ;
        return view("front-office.produits.create",[
            "categories"=>$categories,
            "produit"=>$produit
        ]) ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProduitFormRequest $request)
    {
        //
    //    dd($request->designation) ;




    //    $request->validate([
     //       "designation"=>"required|min:3|max:50|unique:produits" ,
     //       "prix"=>"required|numeric|between:500,1000000",
     //       "description"=>"required|max:200" ,


     //       "category_id"=>"required|numeric"

     //   ]) ;


       // dd($request) ;
       // dd($request->image) ;  prend nom de image

      // dd( time()) ;  nombre de seconde depuis 1970 : c'est une date
     //  dd($request->file('image')) ;
       $imageName = "produit.png" ;
       if($request->file("image")){
            $imageName = time().$request->file("image")->getClientOriginalName() ;
            $request->file("image")->storeAs("public/uploads/produits", $imageName) ;

       }
       $request->session()->put("imageName" , $imageName) ;

        $produit =  Produit::create([
            "designation"=>$request->designation ,
            "prix"=>$request->prix ,
            "category_id"=>$request->category_id ,
            // "category_id"=>$request->category_id
             // ,


            "description"=>$request->description,
            "image"=> $imageName ,
            ]);

            $user = User::first() ;
         // s'assurer que l'utilisateur existe avant l'envoi du mail   if($user)
            if($user)
            Mail::to($user)->send(new ProduitAjoute) ;
            return redirect()->route('produits.index')->with("statut",'Le produit ' .($produit->designation). ' a bien été ajouté') ;
         //   dd($produit) ;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Produit $produit)
    {
        //
        dd($produit) ;

    }



    public function showini($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Produit $produit)
    {
        //
     //   dd($id) ;
     $categories = category::all() ;
        return view("front-office.produits.edit",[


                "produit" =>$produit ,
                "categories" =>$categories ,
        ]) ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //



        // $request->validate([

        //     "designation"=>"required|min:3|max:50|unique:produits,designation,".$id,
        //     "prix"=>"required|numeric|between:500,1000000",
        //     "description"=>"required|max:200" ,


        //     "category_id"=>"required|numeric"

        // ]) ;


       //  important      "designation"=>unique:produits,designation,.$id,

        Produit::where("id", $id)->update([

            "designation" => $request->designation ,

            "prix" => $request->prix ,
            "category_id" => $request->category_id ,
            "description" => $request->description ,



        ]) ;

        $user = User::first();
     // controle si l'utilisateur existe   if($user)
        $user->notify(new ModificationProduit) ;
      return  redirect()->route("produits.index")->with("statut", "Le produit a bien été modifié") ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        Produit::destroy($id) ;
        return redirect()->route('produits.index')->with("statut" , "Le produit a bien été supprimé") ;
    }
}
