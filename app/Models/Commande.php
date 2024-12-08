<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;
    protected $guarded =[];
      // Valider les valeurs de l'énumération
      const STATUT_EN_ATTENTE = 'en_attente';
      const STATUT_CONFIRMEE = 'confirmee';
      const STATUT_EXPEDEE = 'expediee';
      const STATUT_ANNULEE = 'annulee';
  
      // Liste des valeurs possibles
      public static function statuts()
      {
          return [
              self::STATUT_EN_ATTENTE,
              self::STATUT_CONFIRMEE,
              self::STATUT_EXPEDEE,
              self::STATUT_ANNULEE,
          ];
      }
      public function client(){
        return $this->belongsTo(Client::class);
      }
      public function linge_commande(){
        return $this->hasMany(Ligne_commande::class);
      }
}
