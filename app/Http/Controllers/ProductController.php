<?php

namespace App\Http\Controllers;

use App\Exceptions\ProductException;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ApiResponse;
use App\Http\Resources\ProductResource;
use App\Models\Produit;
use App\Repository\ProduitRepository;

class ProductController extends Controller
{
    protected $produitRepository;
    public function __construct(ProduitRepository $produitRepository){
        $this->produitRepository =$produitRepository;
    }
    public function index()
    {
        $produits = $this->produitRepository->getAllProduct();
        return ProductResource::collection($produits);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $validedata =$request->validated();
        $produit =new Produit($validedata);
        $this->produitRepository->saveProduct($produit);
        return ApiResponse::success(new ProductResource($produit),
        'produit enregister avec succes',
        201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $produit =$this->produitRepository->getProductById($id);
        return ApiResponse::success(new ProductResource($produit),
        'success',
        200);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $produit,$id)
    {
        $validedata =$produit->validated();
        $produit =new Produit($validedata);
        $this->produitRepository->updateProduct($produit,$id);
        return ApiResponse::success(new ProductResource($produit),
        'succes',
    200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $produitDeleted =$this->produitRepository->deleteProduct($id);
        if ($produitDeleted) {
            return ApiResponse::success($produitDeleted,'supression reuissié!',200);
             } else {
                 throw new ProductException('Échec de la suppression du client.', 500);
             }
    }
}
