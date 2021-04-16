<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    public $fillable = ["profil"] ;
    use HasFactory;

    public function users()
    {

        return $this->hasMany(User::class) ;


    }
}
