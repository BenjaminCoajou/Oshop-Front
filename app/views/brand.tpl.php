<section class="hero">
    <div class="container">
      <!-- Breadcrumbs -->
      <ol class="breadcrumb justify-content-center">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active"><?= $viewData['brand']->getName() ?></li>
      </ol>
      <!-- Hero Content-->
      <div class="hero-content pb-5 text-center">
        <h1 class="hero-heading"><?= $viewData['brand']->getName() ?></h1>
      </div>
    </div>
  </section>

  <section class="products-grid">
    <div class="container-fluid">

      <header class="product-grid-header d-flex align-items-center justify-content-between">
        <div class="mr-3 mb-3">
          Affichage <strong>1-12 </strong>de <strong>158 </strong>résultats
        </div>
        <div class="mr-3 mb-3"><span class="mr-2">Voir</span><a href="#" class="product-grid-header-show active">12 </a><a
            href="#" class="product-grid-header-show ">24 </a><a href="#" class="product-grid-header-show ">Tout </a>
        </div>
        <div class="mb-3 d-flex align-items-center"><span class="d-inline-block mr-1">Trier par</span>
        <select class="custom-select w-auto border-0">
            <option 
              <?= $viewData['sortedBy'] == null ? 'selected' : '' ?>
              value="<?= $router->generate('catalog-brand', ['brandId' => $viewData['brand']->getId(), 'sort' => 'byname']) ?>">Defaut</option>
            <option 
              <?= $viewData['sortedBy'] == 'byvote' ? 'selected' : '' ?>
              value="<?= $router->generate('catalog-brand', ['brandId' => $viewData['brand']->getId(), 'sort' => 'byvote']) ?>">Popularité</option>
            <option 
              <?= $viewData['sortedBy'] == 'bydate' ? 'selected' : '' ?>
              value="<?= $router->generate('catalog-brand', ['brandId' => $viewData['brand']->getId(), 'sort' => 'bydate']) ?>">Nouveauté</option>
          </select>
        </div>
      </header>
      <div class="row">
        <?php 
            // pour chaque produit de cette liste : 
            foreach($viewData['productList'] as $product) : 
                // on prépare le lien vers la page du produit courant généré via le routeur
                $currentProductLink = $router->generate('catalog-product', ['productId' => $product->getId()]);
                // on stocke aussi le nom de l'image à afficher
                $currentProductImage = $_SERVER['BASE_URI'] . '/' . $product->getPicture();
        ?>
        <!-- product-->
        <div class="product col-xl-3 col-lg-4 col-sm-6">
          <div class="product-image">
            <a href="<?= $currentProductLink ?>" class="product-hover-overlay-link">
              <img src="<?= $currentProductImage ?>" alt="product" class="img-fluid">
            </a>
          </div>
          <div class="product-action-buttons">
            <a href="#" class="btn btn-outline-dark btn-product-left"><i class="fa fa-shopping-cart"></i></a>
            <a href="detail.html" class="btn btn-dark btn-buy"><i class="fa-search fa"></i><span class="btn-buy-label ml-2">Voir</span></a>
          </div>
          <div class="py-2">
            <p class="text-muted text-sm mb-1"><?= $product->getTypeName() ?></p>
            <h3 class="h6 text-uppercase mb-1"><a href="detail.html" class="text-dark"><?= $product->getName() ?></a></h3><span class="text-muted"><?= $product->getPriceWithCurrency() ?></span>
          </div>
        </div>
        <!-- /product-->
        <?php endforeach; ?>
      </div>
    </div>
  </section>