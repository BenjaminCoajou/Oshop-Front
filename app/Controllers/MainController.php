<?php

namespace OShop\Controllers;

use OShop\Models\Product;
use OShop\Models\Category;

class MainController extends CoreController {

    // l'appel dynamique dans index.php (dispatch) transmet à cette méthode les paramètres fournis par le routeur, mais on a pas besoin de ces données ici. On peut ne pas définir de paramètres alors que l'appel à la méthode donne des arguments. Pas grave.
    public function home()
    {
        // ici il faut récupérer les catégories à afficher sur la home
        $categoryModel = new Category();
        $categories = $categoryModel->findAllForHome(); // ouf ! on a une méthode dédiée dans le modèle Category !

        $this->show('home', [
            'categories' => $categories
        ]);
    }

    // action
    // déclencher une erreur 404
    public function error404() {
        // donner un code HTTP choisi
        http_response_code(404);
        $this->show('404');

        // ne pas aller plus loin, car il reste du code à executer sur index.php après le déclenchement de cette méthode
        exit();
    }

    // Modification de la devise courante
    public function changeCurrency($params)
    {
        // on aura besoin du router déclaré sur index.php pour la redirection
        global $router;

        // récupérer la nouvelle devise sélectionnée : 
        $newCurrencyCode = $params['currency'];

        // on vérifie que la devise demandée est une devise gérée sur le site
        // in_array => si la valeur $newCurrencyCode est retrouvée dans le tableau en second argument, on récupère true
        // strtoupper => on transforme la chaîne en majuscules, pour laisser une marge d'erreur sur la saisie
        if (in_array(strtoupper($newCurrencyCode), ['USD', 'GBP', 'EUR'])) {
            // on enregistre en session le code de la devise
            $_SESSION['currency'] = $newCurrencyCode;

            // on redirige vers la page d'où on vient
            // la clé HTTP_REFERER du tableau $_SERVER contient l'adresse de la page de laquelle la requête à été déclenchée
            // Ici c'est l'adresse de la page où l'on était quand on a cliqué sur le lien pour modifier la devise
            $redirectTo = $_SERVER['HTTP_REFERER'];
            header("Location: {$redirectTo}");
        } else {
            $this->error404();
        }

    }

    public function test()
    {
        // j'instancie 1 model Product
        $productModel = new Product();
        // je récupère 1 enregistrement par son id
        $productList = $productModel->findAllByType(2); // $productList est un array d'instances de la classe Product

        dump($productList); // tester le résultat
    }

}
