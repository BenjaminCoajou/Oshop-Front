<?php 

class CatalogController{

    public function category($params){
        $category = new Category();
        $categoryId = $params['categoryId'];

        $categoryToDisplay = $category->find($categoryId);
        $this->show('category',
         ["categoryId" => $categoryId,
         "category" => $categoryToDisplay]);
    }

    public function product($params){
        $product = new Product();
        $productId = $params['productId'];

        $productToDisplay = $product->find($productId);
        
        $this->show('product', 
        ["productId" => $productId,
         "product" => $productToDisplay]);
     } 

     public function type($params){
        $typeId = $params['typeId'];
        $type = new Type ();

        $typeToDisplay = $type->find($typeId);

       $this->show('type',
       ["typeId" => $typeId,
        "type" => $typeToDisplay]);
     }

     public function brand($params){
        $brand = new Brand();
        $brandId = $params['brandId'];

        $brandToDisplay = $brand->find($brandId);

       $this->show('brand',
       ["brandId" => $brandId,
        "brand" => $brandToDisplay]);
     }


    private function show($viewName, $viewVars = array()) {
        // $viewVars est disponible dans chaque fichier de vue
        require_once __DIR__.'/../views/header.tpl.php';
        require_once __DIR__.'/../views/'.$viewName.'.tpl.php';
        require_once __DIR__.'/../views/footer.tpl.php';
      }
}