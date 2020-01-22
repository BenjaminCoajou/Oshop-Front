<?php

namespace Oshop\Controllers;

use \Oshop\Models\Product;
use \Oshop\Models\Brand;
use Oshop\Models\Category;
use Oshop\Models\Type;

/**
 * Ce controller est dédié à l'affiche du catalogue produit.
 */
class CatalogController extends CoreController {

    /**
     * Cette méthode va afficher le template, la vue, des catégories.
     * 
     * @param array $param
     */
    public function category($params) {
        // On recupere les parametres extraits de l'URL
        $idCategory = $params['categoryId'];

        // On charge la catégorie depuis la base de donnée
        $categoryModel = new Category();
        $categoryToDisplay = $categoryModel->find($idCategory);
        
        // Récupérer tous les produits de la catégorie
        $productModel = new Product();
        $productsToDisplay = $productModel->findAllByCategory($idCategory);

        $this->show('category', [
            "category" => $categoryToDisplay,
            "products" => $productsToDisplay
        ]);
    }

    /**
     * Cette méthode va afficher le template, la vue, d'un produit.
     * 
     * @param array $param
     */
    public function product($params) {
        // Je créé un instance de mon modele afin d'utiliser sa fonction
        // find()
        $product = new Product();


        // Grâce à cette fonction, je peux récupér un objet de type
        // Product en donnant simplement l'id du produit
        $productToDisplay = $product->find($params['productId']);
        // ici $productToDisplay est un objet de type Product
        
        $brandId = $productToDisplay->getBrand_id();

        // J'instancie un model de type Brand pour utiliser sa fonction find
        $brandModel = new Brand();
        $brandToDisplay = $brandModel->find($brandId);

        // J'instancie un model de type Type pour utiliser sa fonction find
        $categoryId = $productToDisplay->getCategory_id();
        $categoryModel = new Category();
        $categoryToDisplay = $categoryModel->find($categoryId);

        // On affiche notre template en lui envoyant l'objet Product
        // qu'on a récupéré
        $this->show('product', [
            "product" => $productToDisplay,
            "brand" => $brandToDisplay,
            "category" => $categoryToDisplay
        ]);
    }

    /**
     * Cette méthode va afficher le template, la vue, d'une marque.
     * 
     * @param array $param
     */
    public function brand($params) {

        // On recupere les parametres extraits de l'URL
        $idBrand = $params['brandId'];

        // On charge la catégorie depuis la base de donnée
        $brandModel = new Brand();
        $brandToDisplay = $brandModel->find($idBrand);
        
        // Récupérer tous les produits de la catégorie
        $productModel = new Product();
        $productsToDisplay = $productModel->findAllByBrand($idBrand);

        $this->show('brand', [
            "brand" => $brandToDisplay,
            "products" => $productsToDisplay
        ]);
    }

    /**
     * Cette méthode va afficher le template, la vue, d'un type.
     * 
     * @param array $param
     */
    public function type($params) {
       // On recupere les parametres extraits de l'URL
       $idType = $params['typeId'];

       // On charge la catégorie depuis la base de donnée
       $typeModel = new Type();
       $typeToDisplay = $typeModel->find($idType);
       
       // Récupérer tous les produits de la catégorie
       $productModel = new Product();
       $productsToDisplay = $productModel->findAllByType($idType);

       $this->show('type', [
           "type" => $typeToDisplay,
           "products" => $productsToDisplay
       ]);
    }

}