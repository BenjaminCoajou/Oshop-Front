<?php

namespace Oshop\Controllers;

use \Oshop\Models\Product;
use \Oshop\Models\Category;

// création de la classe MainController
// elle est instanciée pour gérer l'affichage des différentes parties du site
class MainController extends CoreController {

// Cette methode permet d'afficher la home et elle va charger le bon template.
 public function home($params = []){
  $this->show('home');
 }

public function legalMentions($params = []){
  $this->show('legal_mentions');
}

public function error404() {
  // donner un code HTTP choisi
  http_response_code(404);
  $this->show('404');

  // ne pas aller plus loin, car il reste du code à executer sur index.php après le déclenchement de cette méthode
  exit();
}

public function test(){

  $productModel = new Product();
  $product = $productModel-> findAllByType(2);

  dump($product);
}

}