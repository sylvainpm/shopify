<?php

namespace App\Exports;

use App\Models\Produit;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

//  class ProduitsExport implements FromCollection
class ProduitsExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function view():View
    {
        return view('partials._list-produits', [
            'produits'=> Produit::where('prix','>', 5000)->get()
        ]) ;
    }
    // public function collection()
    // {
    //     return Produit::all();
    // }
}
