<?php
namespace App\Services;

use App\Exceptions\ClientException;
use App\Models\Client;
use App\Repository\ClientRepository;
use Exception;
use Illuminate\Support\Facades\Log;

class UpdateClients{
    protected $clientRepository;
    public function __construct(ClientRepository $clientRepository){
        $this->clientRepository =$clientRepository;
    }
    public function updateClient(Client $client,$id){
            $clientUpdate =Client::find($id);
            if(!$clientUpdate){
                throw new ClientException('client non trouvé ou inexistant !',404);
            }
            return $this->clientRepository->update($client,$id);   
    }
}