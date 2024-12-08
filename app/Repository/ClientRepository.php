<?php
namespace App\Repository;

use App\Exceptions\ClientException;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;

class ClientRepository{
    public function saveClient(Client $client){
            return $client->save();
        
    }
    public function getAllClient(){
            $clients =Client::all();
            if(Empty($clients)){
                throw new ClientException("aucun client trouvé",404);
            }else{
                return $clients;
            }
      
    }
    public function getClientByHome(string $quartier){
      
            $clients =Client::where('quartier','=',$quartier)->get();
            if($clients->isEmpty()){
                throw new ClientException("aucun client trouvé dans ce quatier",404);
            }else{
                return $clients;
            }
        
    }
    public function update(Client $client,$id){
        $client = Client::updateOrCreate(
            ['id' => $id], // condition pour identifier le client
            [
                 'id'=>$id,
                'nom' => $client->nom,
                'prenom' => $client->prenom,
                'password' => Hash::make($client->password), // Securisation du mot de passe
                'quartier' => $client->quartier,
                'ville' => $client->ville
            ]
        );
        $client->id =$id;
         return $client;
    }
    public function deleteClient($id){
             $clientUpdate = Client::find($id);

        if (!$clientUpdate) { // Vérifie si le client n'existe pas
            throw new ClientException('Client non trouvé ou inexistant !', 404);
        }
        
        $clientDeleted = $clientUpdate->delete(); // Tente de supprimer le client
        
        if ($clientDeleted) {
       return $clientDeleted;
        } else {
            throw new ClientException('Échec de la suppression du client.', 500);
        }
        
    }
} 