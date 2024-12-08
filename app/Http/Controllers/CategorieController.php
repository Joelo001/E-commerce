<?php

namespace App\Http\Controllers;

use App\Http\Requests\CatergorieRequest;
use App\Http\Resources\ApiResponse;
use App\Http\Resources\CategorieResource;
use App\Models\Categorie;
use App\Repository\CategorieRepository;

class CategorieController extends Controller
{
    protected $categorieRepository;
    public function __construct(CategorieRepository $categorieRepository){
        $this->categorieRepository =$categorieRepository;
    }
    
    public function index()
    {
        $categories =$this->categorieRepository->getAllCategorie();
        return CategorieResource::collection($categories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CatergorieRequest $catergorieRequest)
    {
        $categorie =$catergorieRequest->validated();
        $categorie =new Categorie($categorie);
        $this->categorieRepository->addCategorie($categorie);  
        return ApiResponse::success(new CategorieResource($categorie),
        'nouvelle catergorie crée avec success !',
        201);      
    }

  

    /**
     * Display the specified resource.
     */
    public function show(Categorie $categorie)
    {
        
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(CatergorieRequest $request, $id)
    {
        $categorie =$request->validated();
        $categorie = $this->categorieRepository->updateCategorie($categorie,$id);
        return ApiResponse::success(new CategorieResource($categorie),
        'mise à jour de la categorie effectuer avec success !',
        200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->categorieRepository->deleteCategorie($id);
        return ApiResponse::success([],'suppresion de la categorie effectue avec succes !',200);

    }
}
