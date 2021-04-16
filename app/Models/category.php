<?php

namespace App\Models;

use App\Models\Produit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class category extends Model
{
    use HasFactory;
    public $fillable = ["libelle"] ;

    public function produits()
    {


        return $this->hasMany(Produit::class) ;


    }
}
