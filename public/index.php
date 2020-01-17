<?php

require_once __DIR__ . "/../vendor/autoload.php";

require_once __DIR__ . "/../controllers/MainController.class.php";
require_once __DIR__ . "/../controllers/CatalogController.class.php";


// J'instancie mon Altorouter
$router = new AltoRouter();//

$router->setBasePath($_SERVER['BASE_URI']);

$router->map(
    'GET', // méthode HTTP utilisée (GET ou POST)
    '/', // route à écouter/cartographier
    ['method' => 'home', 'controller' => 'MainController'], //infos supplémentaire envoyées au controller. Méthode du controller à appeler
    'route_home' // nom de la route (nom arbitraire)
);

$router->map(
    'GET',
    '/catalog/product/[i:productId]',
    ['method' => 'product', 'controller' => 'CatalogController'],
    'route_product_by_id'
);

$router->map(
    'GET',
    '/legal-mentions',
    ['method' => 'legalMentions', 'controller' => 'MainController'],
    'route_legal'
);

$router->map(
    'GET',
    '/catalog/category/[i:categoryId]',
    ['method' => 'category', 'controller' => 'CatalogController'],
    'route_category_by_id'
);

$router->map(
    'GET',
    '/catalog/type/[i:typeId]',
    ['method' => 'type', 'controller' => 'CatalogController'],
    'route_type_by_id'
);

$router->map(
    'GET',
    '/catalog/brand/[i:brandId]',
    ['method' => 'brand', 'controller' => 'CatalogController'],
    'route_brand_by_id'
);






// La fonction match() detecte si une route précedement défini est utilisé dans le navigateur
$match = $router->match();
dump($match);

if( $match === false){
    $mainController = new MainController();
    $mainController->error404();
    exit;
}


// Afficher la page
// récupération de la cible de la route
$target =$match["target"];

// récupération du nom de la method
$nomDelaMethode = $target["method"];

// récupération du nom du controller
$nomDuController = $target["controller"];

// J'instancie mon controller
$controller = new $nomDuController();

$controller->$nomDelaMethode($match["params"]);

//$pages = [
    //"/" => "home",
    //"/product" => "product"
//];

// Définition de la fonction à appeler
//$nomDeLaFonction = $pages["/"];

// Vérification de la réception du nom de page à afficher
//if (isset($_GET['_url'])){

    // Récupération via GET de la page demandée
    //$requestedPage = $_GET['_url'];

    // Test si la page est bien dans la liste
    //if(isset($pages[$requestedPage])){
        // récupération de la méthode à appeler
        //$nomDeLaFonction = $pages[$requestedPage];
    //}
//}

// Appeler la métode du controller qui va afficher le template
// Appel "dynamique" de fonction (le nom de loa fonction est stockée dans une variable)
//$controller->$nomDeLaFonction();