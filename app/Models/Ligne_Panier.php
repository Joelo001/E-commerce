<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ligne_Panier extends Model
{
    use HasFactory;
    protected $guarded =[];
    public function panier(){
        return $this->belongsTo(Panier::class);
    }
    public function produit(){
        return $this->BelongsTo(Produit::class);
    }
}
