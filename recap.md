# Récap o'Shop

## Structure
- deux répertoires principaux :
    - app => contient tout le code du site
        - controllers
        - views
    - public
        - contient le point d'entrée "index.php"
        - les assets (ressources) => css, javascript, images...

- le fichier .htaccess doit se trouver dans le répertoire public, plus globalement, ce htaccess pour la réécriture doit se trouver dans le même répertoire qu'index.php.


## Ajouter une page :

- ajouter une route dans la définition des routes (mapping)
- créer (au besoin) le ou les model(s) nécessaires à la view
- créer la méthode de contrôleur
    - récupérer les données nécessaires
- créer la view

## Chemins relatifs

Nos chemins relatifs (notamment vers nos assets) sont perturbés lorsque nous sommes sur une page dont l'URL ressemble à `catalog/category/3`. Dans ce cas, le navigateur pense qu'on consulte un fichier "3" qui se trouve dans le répertoire "public/catalog/category/3" => les liens et url relatives se base donc sur ce répertoire "category". Pb => nos ressources se trouvent dans `public/assets/`.


La solution est d'utiliser une URL *absolue* => qui ne change pas en fonction du répertoire où l'on se trouve (où le navigateur pense qu'on est).
Ô Joie ! Le fichier .htaccess définit une variable de serveur qui s'appelle `BASE_URI` et qui contient l'url absolue vers le répertoire public (sans tenir compte de l'url courante).


On peut récupérer cette valeur en PHP via le tableau super global `$_SERVER` à la clé `BASE_URI`. => chez moi `$_SERVER['BASE_URI']` vaut `/Asgard/S05/s05-projet-oshop-GaetanOclock/public` (attention pas de slash final, il faudra penser à l'ajouter à nos urls)

On utilisera donc cette valeur pour construire nos URL.

## Installation des dépendances

Pour télécharger effectivement le code des dépendances composer d'un projet, il faut 
 - **SE PLACER À LA RACINE DU PROJET**
 - utiliser la commande `composer install`

