<?php

namespace OShop\Controllers;

// on déclare que ce fichier va utiliser la classe Product qui est définie dans le namespace \OShop\Models
use \OShop\Models\Product;
use \OShop\Models\Category;
use \OShop\Models\Brand;
use \OShop\Models\Type;

class CatalogController extends CoreController {

    // page Catégorie
    // cette méthode a besoin d'un id pour fonctionner
    // => chercher les données en se basant sur cet id
    // $params contient les données extraites de l'url par le routeur
    public function category($params)
    {
        // dans $params, je récupère l'id de la catégorie
        $categoryId = $params['categoryId'];
        // je récupère aussi le tri demandé s'il existe
        if (isset($params['sort'])) {
            $sortBy = $params['sort'];
        } else {
            $sortBy = null;
        }

        // afficher la vue catégorie
        // Données pour la vue :
        // Les données de la catégorie courante (pour afficher le titre, le sous titre)
        $categoryModel = new Category();
        $category = $categoryModel->find($categoryId);
        // Les données de tous les produits qui appartiennent à CETTE catégorie 
        $productModel = new Product();
        $productList = $productModel->findAllByCategory($categoryId, $sortBy);

        $this->show('category', [
            'category' => $category,
            'productList' => $productList,
            'sortedBy' => $sortBy
        ]); 
    }

    public function product($params)
    {
        // récupérer le produit (un objet Product) en fonction de l'id passé dans $params
        $productModel = new Product();
        $product = $productModel->find($params['productId']);

        // récupérer la catégorie qui correspond à ce produit pour le fil d'ariane
        // on utilise l'id de la catégorie définie sur le Product
        $categoryModel = new Category();
        $category = $categoryModel->find($product->getCategoryId());

        // déclencher l'affichage à l'aide de la méthode show (à laquelle on passe les données récupérées)
        $this->show('product', [
            'product' => $product, // l'objet Product récupéré
            'category' => $category // l'objet Category Récupéré
        ]);
    }

    public function brand($params)
    {
        // cette méthode fait sensiblement la même chose que la méthode category() plus haut,
        // mais les données utilisées sont celles qui concernent la marque
        $brandId = $params['brandId'];

        // je récupère aussi le tri demandé s'il existe
        if (isset($params['sort'])) {
            $sortBy = $params['sort'];
        } else {
            $sortBy = null;
        }

        // afficher la vue brand
        // Données pour la vue :
            // Les données de la marque courante (pour afficher le titre)
            $brandModel = new Brand();
            $brand = $brandModel->find($brandId);
            // Les données de tous les produits qui appartiennent à cette marque 
            $productModel = new Product();
            $productList = $productModel->findAllByBrand($brandId, $sortBy);

        $this->show('brand', [
            'brand' => $brand,
            'productList' => $productList,
            'sortedBy' => $sortBy
        ]); 
    }

    public function type($params)
    {
        // cette méthode fait sensiblement la même chose que les méthodes category() et brand() plus haut,
        // mais les données utilisées sont celles qui concernent le type
        $typeId = $params['typeId'];

        // je récupère aussi le tri demandé s'il existe
        if (isset($params['sort'])) {
            $sortBy = $params['sort'];
        } else {
            $sortBy = null;
        }

        // afficher la vue type
        // Données pour la vue :
            // Les données du type courant (pour afficher le titre, le sous titre)
            $typeModel = new Type();
            $type = $typeModel->find($typeId);
            // Les données de tous les produits qui appartiennent à CETTE catégorie 
            $productModel = new Product();
            $productList = $productModel->findAllByType($typeId, $sortBy);

        $this->show('type', [
            'type' => $type,
            'productList' => $productList,
            'sortedBy' => $sortBy
        ]); 
    }
}
