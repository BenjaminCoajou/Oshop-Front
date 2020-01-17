<?php

// création de la classe MainController
// elle est instanciée pour gérer l'affichage des différentes parties du site
class MainController {

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


// Elle affiche le template demandé.
// Pour choisir le template à afficher elle prend un arguement $viewName (string) et un argument $viewVars (array)
private function show($viewName, $viewVars = array()) {
    // $viewVars est disponible dans chaque fichier de vue
    require_once __DIR__.'/../views/header.tpl.php';
    require_once __DIR__.'/../views/'.$viewName.'.tpl.php';
    require_once __DIR__.'/../views/footer.tpl.php';
  }

}