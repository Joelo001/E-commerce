<?php
namespace App\Repository;

use App\Exceptions\CategorieException;
use App\Models\Categorie;

class CategorieRepository{
    public function addCategorie(Categorie $categorie){
        $categoriesave =$categorie->save();
        if(!$categoriesave){
            throw new CategorieException('Erreur lors de l ajout de la nouvelle catégorie !',500);
        }
        return $categoriesave;

    }
    public function getAllCategorie(){
        $Categories =Categorie::all();
        if($Categories->isEmpty()){
            throw new CategorieException('aucune catégorie trouvé !',404);
        }
        return $Categories;
    }
    public function updateCategorie(Categorie $categorie,$id){
        $categorieUpdate =Categorie::find($id);
        if(empty($categorieUpdate)){
            throw new CategorieException('cette categorie n existe pas !',404);
        }
        $result =$categorieUpdate->update([
            'id'=>$categorie->id,
            'name'=>$categorie->name
        ]);
        if(!$result){
            throw new CategorieException('Erreur lors de la mise à jour de la categorie !',500);
        }
        return $categorieUpdate;
    }
    public function deleteCategorie($id){
        $categorieDelete =Categorie::find($id);
        if(empty($categorieDelete)){
            throw new CategorieException('cette categorie n existe pas !',404);
        }
        $result =$categorieDelete->delete();
        if(!$result){
            throw new CategorieException('Erreur lors de la supression  de la categorie !',500);
        }
        return $result;
    }
}