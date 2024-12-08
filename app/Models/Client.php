<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $guarded =[];
    protected $hidden = ['password'];
    public function commande(){
        return $this->hasMany(Commande::class);
    }
    public function panier(){
        return $this->hasOne(Panier::class);
    }
}
