<?php 

class CatalogController{

    public function category($params = []){
        $this->show('category');
    }

    public function product($params = []){
              $this->show('product', ["id" => $params]);
     } 

     public function type($params){
       $this->show('type', ["id" => $params]);
     }

     public function brand($params){
       $this->show('brand', ["id" => $params]);
     }


    private function show($viewName, $viewVars = array()) {
        // $viewVars est disponible dans chaque fichier de vue
        require_once __DIR__.'/../views/header.tpl.php';
        require_once __DIR__.'/../views/'.$viewName.'.tpl.php';
        require_once __DIR__.'/../views/footer.tpl.php';
      }
}