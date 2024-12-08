<?php

namespace App\Http\Controllers;
use App\Exceptions\ClientException;
use App\Http\Requests\ClientRequest;
use App\Http\Resources\ApiResponse;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use App\Repository\ClientRepository;
use App\Http\Requests\EditClientRequest;
use App\Services\UpdateClients;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Hash;

class ApiClientController extends Controller
{
    protected $clientRepository;
    protected $clientService;

   
    public function __construct(ClientRepository $clientRepository,UpdateClients $updateClients)
    {
        $this->clientRepository = $clientRepository;
        $this->clientService=$updateClients;
    }
    public function index(){

            $clients =$this->clientRepository->getAllClient();
            return  ClientResource::collection($clients);

    }
    public function store(ClientRequest $request){
            $validateData = $request->validated();
            $client = new Client($validateData);
            $client->password=Hash::make($validateData['password']);
            $this->clientRepository->saveClient($client);
            return ApiResponse::success(new ClientResource($client),'client enregister avec succes!',201);
      
    }
    public function update(EditClientRequest $editClientRequest,$id){
            $validateData =$editClientRequest->validated();
            $client = new Client($validateData);
            $client->password=Hash::make($validateData['password']);
         $clientupdate =$this->clientService->updateClient($client,$id);
            return ApiResponse::success(new ClientResource($clientupdate),
        'mise à jours du client effectué avec succes!',
            200);

    

    }
    public function findClientByQuartier($quartier){
            if(Empty($quartier)||!is_string($quartier)){
                return ApiResponse::error('something is wrong ! ',
                'Le quartier doit être une chaîne de caractères non vide.',
                422);
            }
            $clients =$this->clientRepository->getClientByHome($quartier);
            return ClientResource::collection($clients);
        

    }

    public function delete($id){
        $this->clientRepository->deleteClient($id);
        return ApiResponse::success( true, 'Suppression du client réussie !', 200);

    }
}
