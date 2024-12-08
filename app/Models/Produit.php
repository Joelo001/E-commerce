<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;
    protected $guarded =[];
    protected $cast =[
        'prix'=>'float',
        'stock'=>'integer',
        'active'=>'boolean'

    ];
    public function isAvailable()
{
    return $this->active && $this->stock > 0;
}
public function categorie(){
    return $this->belongsTo(Categorie::class);
}
public function ligne_commande(){
    return $this->hasMany(Ligne_commande::class);
}
public function ligne_panier(){
    return $this->belongsTo(Ligne_Panier::class);
}
}
