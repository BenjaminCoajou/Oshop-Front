<?php

// création de la classe MainController
// elle est instanciée pour gérer l'affichage des différentes parties du site
class MainController {

// Cette methode permet d'afficher la home et elle va charger le bon template.
 public function home(){
    $this->show('home');
 }
 // Cette methode permet d'afficher la la page produit et elle va charger le bon template.
 public function product(){
    $this->show('product');
} 
// Cette methode permet d'afficher la page magasin et elle va charger le bon template.
public function store(){
    $this->show('store');
}
// Cette methode permet d'afficher la page à propos et elle va charger le bon template.
public function about(){
  $this->show('about');
}

// Elle affiche le template demandé.
// Pour choisir le template à afficher elle prend un arguement $viewName (string) et un argument $viewVars (array)
private function show($viewName, $viewVars = array()) {
    // $viewVars est disponible dans chaque fichier de vue
    require_once __DIR__.'/../views/header.tpl.php';
    require_once __DIR__.'/../views/'.$viewName.'.tpl.php';
    require_once __DIR__.'/../views/footer.tpl.php';
  }

}