<section>
    <div class="container-fluid">
      <div class="row mx-0">
        <?php for($i=0; $i<2; $i++) : ?>
        <div class="col-md-6">
          <div class="card border-0 text-white text-center"><img src="<?= $_SERVER['BASE_URI']?>/<?= $viewVars['homeCategory'][$i]->getPicture()?>"
              alt="Card image" class="card-img">
            <div class="card-img-overlay d-flex align-items-center">
              <div class="w-100 py-3">
                <h2 class="display-3 font-weight-bold mb-4"><?= $viewVars['homeCategory'][$i]->getName()?></h2><a href="category.html" class="btn btn-light"><?= $viewVars['homeCategory'][$i]->getSubtitle()?></a>
              </div>
            </div>
          </div>
        </div>
        <?php endfor; ?>
        
      <div class="row mx-0">
      <?php for($i=2; $i<5; $i++) : ?>
        <div class="col-lg-4">
          <div class="card border-0 text-center text-white"><img src="<?= $_SERVER['BASE_URI']?>/<?= $viewVars['homeCategory'][$i]->getPicture()?>"
              alt="Card image" class="card-img">
            <div class="card-img-overlay d-flex align-items-center">
              <div class="w-100">
                <h2 class="display-4 mb-4"><?= $viewVars['homeCategory'][$i]->getName()?></h2><a href="category.html" class="btn btn-link text-white"><?= $viewVars['homeCategory'][$i]->getSubtitle()?>
                  <i class="fa-arrow-right fa ml-2"></i></a>
              </div>
            </div>
          </div>
        </div>
        <?php endfor; ?>

<!--      <div class="col-lg-4">
            <div class="card border-0 text-center text-dark">
              <img src="<?= $_SERVER['BASE_URI']?>/assets/images/categ1.jpeg"
                alt="Card image" class="card-img">
              <div class="card-img-overlay d-flex align-items-center">
                <div class="w-100">
                  <h2 class="display-4 mb-4">Détente</h2>
                  <a href="category.html" class="btn btn-link text-dark">Se faire plaisir
                    <i class="fa-arrow-right fa ml-2"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        <div class="col-lg-4">
          <div class="card border-0 text-center text-white">
            <img src="<?= $_SERVER['BASE_URI']?>/assets/images/categ3.jpeg"
              alt="Card image" class="card-img">
            <div class="card-img-overlay d-flex align-items-center">
              <div class="w-100">
                <h2 class="display-4 mb-4">Cérémonie</h2>
                <a href="category.html" class="btn btn-link text-white">Bien choisir 
                  <i class="fa-arrow-right fa ml-2"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div> -->
  </section>