<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProduitFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
       // return false;
       return true ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
      //  dd($this->produit) ;
        return [

            //
         // initial   "designation"=>"required|min:3|max:50|unique:produits" ,
     //update    "designation"=>"required|min:3|max:50|unique:produits,designation,".$id,
    // "designation"=>"required|min:3|max:50|unique:produits,designation,".$this->produit->id,
   //  $this->produit  et non  $this->produit->id  car les routes sont de type ressource et le paramètre c'est produit  "designation"=>"required|min:3|max:50|unique:produits,designation,".$this->produit,


   // designation,".$this->produit=exeption sur designation      "designation"=>"required|min:3|max:50|unique:produits,designation,".$this->produit,
   "designation"=>"required|min:3|max:50|unique:produits,designation,".$this->produit,
            "prix"=>"required|numeric|between:500,1000000",
            "description"=>"required|max:200" ,


            "category_id"=>"required|numeric"
        ];
    }
}
