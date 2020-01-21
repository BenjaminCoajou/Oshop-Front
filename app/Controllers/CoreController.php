<?php

namespace Oshop\Controllers;

use \Oshop\Models\Category;
use \Oshop\Models\Brand;
use \Oshop\Models\Type;

class CoreController {


    protected function show($viewName, $viewVars = array()) {

        // récupération des données qui seront toujours nécessaires
        $brandObject = new Brand();
        $viewVars['footerBrandList'] = $brandObject->findAllForFooter();

        $typeObject = new Type();
        $viewVars['footerTypeList'] = $typeObject->findAllForFooter();
        
        $categoryObject = new Category();
        $viewVars['homeCategory'] = $categoryObject->findAllForHome();

        global $router;

        // $viewVars est disponible dans chaque fichier de vue
        require_once __DIR__.'/../views/header.tpl.php';
        require_once __DIR__.'/../views/'.$viewName.'.tpl.php';
        require_once __DIR__.'/../views/footer.tpl.php';
      }
}