<section>
    <div class="container-fluid">
        <div class="row mx-0">
            <?php
              // ici c'est assez pariculier, on doit faire occuper la moitié de l'espace dispo aux 2 premiers blocs et le tiers aux 3 derniers.
              // pour réussir cette prouesse technique, on initialise un compteur. On va boucler, donc il faudra pouvoir se repérer.
              $counter = 1; // je commence à 1, mais c'est un choix arbitraire.

              // pour chaque catégorie transmise par le controller, je définis une variable $category
              foreach($viewData['categories'] as $category) : 
                // si le compteur est supérieur à 2 (donc que je suis en train de traiter moi troisième élément ou +)
                // je prévoir que la classe à appliquer au bloc est col-md-4
                if ($counter > 2) {
                  $class = 'col-md-4';
                } else {
                  // sinon (ça concernera les 2 premiers éléments) je prévois col-md-6
                  $class = 'col-md-6';
                }
                
                // je n'oublie pas d'incrémenter mon compteur, sinon il ne dépassera jamais 1 (malin !)
                $counter++; 
                // je stocke le lien vers cette catégorie, généré avec AltoRouter pour l'utiliser plus facilement dans le HTML
                $currentCategoryLink = $router->generate('catalog-category', ['categoryId' => $category->getId()]);
            ?>
            <div class="<?= $class ?>">
                <div class="card border-0 text-white text-center"><img src="<?= $_SERVER['BASE_URI'] ?>/<?= $category->getPicture() ?>" alt="Card image"
                        class="card-img">
                    <div class="card-img-overlay d-flex align-items-center">
                        <div class="w-100 py-3">
                            <h2 class="display-3 font-weight-bold mb-4"><?= $category->getName() ?></h2><a href="<?= $currentCategoryLink ?>"
                                class="btn btn-light"><?= $category->getSubtitle() ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>