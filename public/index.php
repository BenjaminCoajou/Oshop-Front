<?php

require_once __DIR__ . "/../controllers/MainController.class.php";

// J'instancie mon controller
$controller = new MainController();

$pages = [
    "/" => "home",
    "/product" => "product"
];

// Définition de la fonction à appeler
$nomDeLaFonction = $pages["/"];

// Vérification de la réception du nom de page à afficher
if (isset($_GET['_url'])){

    // Récupération via GET de la page demandée
    $requestedPage = $_GET['_url'];

    // Test si la page est bien dans la liste
    if(isset($pages[$requestedPage])){
        // récupération de la méthode à appeler
        $nomDeLaFonction = $pages[$requestedPage];
    }
}

// Appeler la métode du controller qui va afficher le template
// Appel "dynamique" de fonction (le nom de loa fonction est stockée dans une variable)
$controller->$nomDeLaFonction();