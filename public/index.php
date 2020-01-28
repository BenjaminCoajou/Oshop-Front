<?php

// on démarre la session pour pouvoir l'utiliser dans la gestion de la devise
session_start();

// index.php = c'est le point d'entrée de l'application
// => FrontController

// utiliser les dépendances installées via composer :
require __DIR__ . '/../vendor/autoload.php';

// // récupérer les classes
require_once __DIR__ . '/../app/utils/Database.php';
// require_once __DIR__ . '/../app/controllers/CoreController.php';
// require_once __DIR__ . '/../app/controllers/MainController.php';
// require_once __DIR__ . '/../app/controllers/CatalogController.php';

// require_once __DIR__ . '/../app/models/CoreModel.php';
// require_once __DIR__ . '/../app/models/Product.php';
// require_once __DIR__ . '/../app/models/Category.php';
// require_once __DIR__ . '/../app/models/Brand.php';
// require_once __DIR__ . '/../app/models/Type.php';

use OShop\Controllers\MainController;
use OShop\Controllers\CatalogController;

// 1. instancier un nouvel objet AltoRouter
$router = new AltoRouter();

// paramétrer altoRouter pour fonctionner dans notre sous-dossier
$router->setBasePath($_SERVER['BASE_URI']);
// à partir de là, $router (objet AltoRouter) connait la route demandée par l'utilisateur 
    // pour la home => '/',
    // pour la page catégorie => '/catalog/category/[categoryId]'

// 2. Définir les routes qui existent sur le site
// la méthode map() du routeur me permet de définir une route
// argument #1 : méthode HTTP de la requête (GET pour afficher une page, POST pour traiter un formulaire)
// argument #2 : la route elle-même (la partie de l'url qui est amenée à changer en fonction de la page demandée)
// argument #3 : la cible => la méthode de contrôleur à déclencher (juste une donnée qu'on stocke pour cette route et qu'on utilisera plus tard)
// argument #4 : le nom de la route choisi arbitrairement, on s'en servira plus tard pour retrouver cette route en particulier
$router->map(
    'GET',
    '/',
    [
        'method' => 'home',
        'controller' => 'MainController'
    ],
    'homepage'
);

// déclaration route category
// définir une partie variable dans la route avec AltoRouter :
// on utilise des [] pour délimiter la variable
// 2 valeurs dans les [] :
    // à gauche des ":" on donne le type de la variable (en gros, integer ou texte)
    // à droite des ":" on donne le nom de la variable
$router->map(
    'GET',
    '/catalog/category/[i:categoryId]/[a:sort]?',
    [
        'method' => 'category',
        'controller' => 'CatalogController'
    ],
    'catalog-category'
);

$router->map(
    'GET',
    '/test/',
    [
        'method' => 'test',
        'controller' => 'MainController'
    ],
    'test'
);

$router->map(
    'GET',
    '/catalog/brand/[i:brandId]/[a:sort]?',
    [
        'method' => 'brand',
        'controller' => 'CatalogController'
    ],
    'catalog-brand'
);

$router->map(
    'GET',
    '/catalog/type/[i:typeId]/[a:sort]?',
    [
        'method' => 'type',
        'controller' => 'CatalogController'
    ],
    'catalog-type'
);

$router->map(
    'GET',
    '/catalog/product/[i:productId]',
    [
        'method' => 'product',
        'controller' => 'CatalogController'
    ],
    'catalog-product'
);

$router->map(
    'GET',
    '/change-currency/[a:currency]',
    [
        'method' => 'changeCurrency',
        'controller' => 'MainController'
    ],
    'change-currency'
);

// 3. Exécuter la méthode de contrôleur qui correspond à la route demandée
// faire le dispatch
// faire correspondre l'url courante avec les routes mappées
// AltoRouteur sait faire cette comparaison tout seul
$match = $router->match(); // dans $match on récupère false en cas de route non trouvée, et des données sur cette route sinon
// dans le cas où l'url contient une partie variable, $match contient un array à la clé "params" => cet array contient une clé par variable dans l'url. On passera par cette clé "params" pour récupérer ces valeurs dans le controller

// 4. TODO: Vérifier que la route courante était prévue sur le site (sinon 404)
if ($match === false) {
    // on a pas trouvé de correspondance, on affiche une page 404 + code HTTP 404
    $mainController = new MainController();
    $mainController->error404();
}

// on définit la méthode à exécuter sur le controller en récupérant le nom de cette méthode dans le tableau $match (à la clé target)  :
$methodToUse = $match['target']['method'];

// on définit le contrôleur à instancier en récupérant le nom de ce contrôleur dans le tableau $match (à la clé target)  :
$controllerToUse = '\OShop\\Controllers\\' . $match['target']['controller'];

// On ne doit pas instancier toujours le même controleur, par exemple
 // MainController pour la home
 // CatalogController pour la page catégorie
// on utilise la valeur de $controllerToUse pour faire une instanciation dynamique
$controller = new $controllerToUse();
// exécuter dynamiquement la méthode de contrôleur qui correspond à la route
$controller->$methodToUse($match['params']);