<section class="hero">
    <div class="container">
      <!-- Breadcrumbs -->
      <ol class="breadcrumb justify-content-center">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active"><?= $viewData['category']->getName(); ?></li>
      </ol>
    </div>
  </section>

  <section class="products-grid">
    <div class="container-fluid">

      <div class="row">
        <!-- product-->
        <div class="col-lg-6 col-sm-12">
          <div class="product-image">
            <a href="detail.html" class="product-hover-overlay-link">
              <img src="<?= $_SERVER['BASE_URI'] ?>/<?= $viewData['product']->getPicture(); ?>" alt="<?= $viewData['product']->getName(); ?>" class="img-fluid">
            </a>
          </div>
        </div>
        <div class="col-lg-6 col-sm-12">
          <div class="mb-3">
            <h3 class="h3 text-uppercase mb-1"><?= $viewData['product']->getName(); ?></h3>
            <div class="text-muted">by <em><?= $viewData['product']->getBrandName(); ?></em></div>
            <div>
                <?php 
                    // on traite étoile par étoile (de 1 à 5)
                    for ($i = 1; $i <= 5; $i++)  {
                        
                        $class = 'fa-star';

                        // si le numéro de l'étoile courante (sa position) est supérieure à la note obtenue, c'est que l'étoile est vide
                        if ($i > $viewData['product']->getRate()) {
                            $class = 'fa-star-o';
                        }

                        echo "<i class=\"fa {$class} \"></i> ";
                    }
                ?>
            </div>
          </div>
          <div class="my-2">
            <div class="text-muted"><span class="h4"><?= $viewData['product']->getPriceWithCurrency(); ?></span> TTC</div>
          </div>
          <div class="product-action-buttons">
            <form action="" method="post">
              <input type="hidden" name="product_id" value="1">
              <button class="btn btn-dark btn-buy"><i class="fa fa-shopping-cart"></i><span class="btn-buy-label ml-2">Ajouter au panier</span></button>
            </form>
          </div>
          <div class="mt-5">
            <p>
            <?= $viewData['product']->getDescription(); ?>
            </p>
          </div>
        </div>
        <!-- /product-->
      </div>
      
    </div>
  </section>