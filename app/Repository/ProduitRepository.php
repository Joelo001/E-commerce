<?php
namespace App\Repository;

use App\Exceptions\ProductException;
use App\Models\Produit;

class ProduitRepository{
    public function saveProduct(Produit $produit){
        if($produit->prix<=0){
            throw new ProductException('le prix d un produit ne peut être negatifs ou nul !',400);
        }
        if($produit->stock<0){
            throw new ProductException('le stock d un produit ne peut être negatifs  !',400);
        }
        if(!$produit->save()){
            throw new ProductException('Echec de la sauvegarde du stock',400);
        }
      return $produit->save();
    }
    public function getAllProduct(){
        $produits =Produit::all();
        if($produits->isEmpty()){
            throw new ProductException('aucun produit en stock',404);
        }
        return $produits;
    }
    public function getProductById($id){
        $produit = Produit::find($id);
        if(empty($produit)){
            throw new ProductException('produit non trouvé ! ',404);
        }
        return $produit;
    }
    public function updateProduct(Produit $produit,$id){
        $this->getProductById($id);
        $updateProduit =Produit::where('id','=',$id)
                                ->update([
                                    'id'=>$id,
                                    'name'=>$produit->name,
                                    'description'=>$produit->description,
                                    'stock'=>$produit->stock,
                                    'active'=>$produit->active
                                ]);
            if(!$updateProduit){
                throw new ProductException('Echec de la mise à jour du Produit !',400);
            }
             return $produit->id=$id;
    }
    public function getProductByString(string $motcles){
        $produits =Produit::where('name','=',$motcles)->get();
        if($produits->isEmpty()){
            throw new ProductException('aucun produit de ce nom dans les stocks !',404);
        }
        return $produits;
    }
    public function getProductByField(string $field ,string $description){
        $produits =Produit::where($field,'=',$description)->get();
        if($produits->isEmpty()){
            throw new ProductException('aucun produit trouve dans les stocks !',404);
        }
        return $produits;
    }
    public function deleteProduct($id){
        $produits =$this->getProductById($id);
        return $produits->delete();     

    }
}