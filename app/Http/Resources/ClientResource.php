<?php

namespace App\Http\Resources;

use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return([
            'id'=>$this->id,
            'nom'=>$this->nom,
            'prenom'=>$this->prenom,
            'email' => $this->email,
            'quartier'=>$this->quartier,
            'ville'=>$this->ville,
        ]);
    }
}
