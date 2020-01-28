<?php

// ce fichier appartient à un namespace donné
namespace OShop\Controllers;

use OShop\Models\Brand;
use OShop\Models\Type;

class CoreController {

    // récupérer les infos pour le sélecteur de devise
    protected function getCurrencyList()
    {
        // récupérer la devise courante s'il y en a une
        if (isset($_SESSION['currency'])) {
            $currentCurrency = $_SESSION['currency'];
        } else {
            // valeur par défaut
            $currentCurrency = 'EUR';
        }

        // on créée un tableau vide pour contenir notre liste
        $currencyList = [];
        // on doit mettre de côté la devise courante (pour l'afficher déjà sélectionnée dans la view)
        // pour chaque devise possible
        $allCurrencies = ['USD', 'EUR', 'GBP'];
        foreach ($allCurrencies as $currency) {
            // si cette devise n'est pas la devise choisie en session, on peut l'ajouter à la liste
            if ($currentCurrency != $currency) {
                $currencyList[] = $currency;
            } 
        }

        // on retourne un array qui contient la liste des devises non sélectionnées ET la devise sélectionnée
        $finalCurrencyList = ['currentCurrency' => $currentCurrency, 'otherCurrencies' => $currencyList];
        return $finalCurrencyList;
    }

    // afficher les views
    protected function show($currentPage, $viewData = []) {

        // récupérer le router depuis sa déclaration sur index.php
        global $router;
        
        // Ici, on récupère les données qui seront TOUJOURS nécessaires
        // par exemple la liste des marques pour le footer : le footer est TOUJOURS affiché, il a donc TOUJOURS besoin des données
        $brandObject = new Brand();
        $viewData['footerBrandList'] = $brandObject->findAllForFooter();
        // idem pour la liste des types de produits
        $typeObject = new Type();
        $viewData['footerTypeList'] = $typeObject->findAllForFooter();

        // on passe la liste des devises aux vues
        $viewData['currencyList'] = $this->getCurrencyList();
        
        // attention, ici, dans MainController.php, __DIR__ vaut /var/www/html/..../s05-projet-oshop-GaetanOclock/controllers
        require_once __DIR__ . "/../views/header.tpl.php";
        require_once __DIR__ . "/../views/{$currentPage}.tpl.php";
        require_once __DIR__ . "/../views/footer.tpl.php";
    }

}