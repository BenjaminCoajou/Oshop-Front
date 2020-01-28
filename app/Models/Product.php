<?php

namespace OShop\Models;

// on hérite de CoreModel, comme tout model qui se respecte
class Product extends CoreModel {

    private $description;
    private $picture;
    private $price;
    private $rate;
    private $status;
    private $brand_id;
    private $category_id;
    private $type_id;
    
    private $brand_name; // n'est pas réellement une colonne de la table product, mais on va rajouter ce champ grâce aux jointures
    private $type_name; // idem

    /**
     * Get the value of type_id
     */ 
    public function getType_id()
    {
        return $this->type_id;
    }

    /**
     * Set the value of type_id
     *
     */ 
    public function setType_id($type_id)
    {
        $this->type_id = $type_id;


    }

    

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     */ 
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get the value of picture
     */ 
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set the value of picture
     *
     */ 
    public function setPicture($picture)
    {
        $this->picture = $picture;


    }

    /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     */ 
    public function setPrice($price)
    {
        $this->price = $price;


    }

    /**
     * Get the value of rate
     */ 
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set the value of rate
     *
     */ 
    public function setRate($rate)
    {
        $this->rate = $rate;


    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     */ 
    public function setStatus($status)
    {
        $this->status = $status;


    }

    /**
     * Get the value of brand_id
     */ 
    public function getBrand_id()
    {
        return $this->brand_id;
    }

    /**
     * Set the value of brand_id
     *
     */ 
    public function setBrand_id($brand_id)
    {
        $this->brand_id = $brand_id;


    }

    /**
     * Get the value of category_id
     */ 
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * Set the value of category_id
     *
     */ 
    public function setCategoryId($category_id)
    {
        $this->category_id = $category_id;
    }

    /**
     * Get the value of brand_name
     */ 
    public function getBrandName()
    {
        return $this->brand_name;
    }
    
    /**
     * Get the value of type_name
     */ 
    public function getTypeName()
    {
        return $this->type_name;
    }

    /**
     * Récupérer le prix en fonction de la devise courante. On récupère une string pour pouvoir faire varier également
     * le caractère associé à la monnaie
     * 
     * @return string
     */
    public function getPriceWithCurrency()
    {
        // on récupère la devise en session
        if (isset($_SESSION['currency'])) {
            $currencyCode = $_SESSION['currency'];
        } else {
            // valeur par défaut
            $currencyCode = 'EUR';
        }

        // on déclare les taux qui correspondent à chaque devise dans un array.
        // on pourra retrouver un taux (qui servira à calculer en partant d'Euros) en partant du code de la devise
        $currencyList = [
            'EUR' => ['rate' => 1, 'char' => '&euro;'],
            'USD' => ['rate' => 1.1, 'char' => '$'],
            'GBP' => ['rate' => 0.84, 'char' => '&pound;']
        ];

        // on récupère les infos de la devise sélectionnée : 
        $currency = $currencyList[$currencyCode];

        // on calcule le prix et on le formate en chaîne avec forcément 2 décimales (format 10.00)
        $formattedPrice = number_format($this->getPrice() * $currency['rate'], 2);
        // on calcule le prix tout en générant la chaîne de caractères complète :
        $priceWithCurrency = $formattedPrice . ' ' . $currency['char'];

        // on retourne la chaîne 
        return $priceWithCurrency;
    }


    /**
     * Récupère un produit dans la base de donnée.
     * Par son id
     * 
     * @param int $id
     * @return Product
     */
    public function find($productId) {
        // Je construis ma requete
        $sql = "
        SELECT 
        `product`.*,
        `brand`.`name` AS 'brand_name'
        FROM `product`
        INNER JOIN `brand` ON `product`.`brand_id` = `brand`.`id` 
        WHERE `product`.`id`= {$productId}
        ";

        // Je recupere la connexion à la BDD
        $pdo = \Database::getPDO();

        // J'execute la requete
        $statement = $pdo->query($sql);

        // Je recupère le resultat
        // fetchObject => recupère 1 résultat
        // $statement->fetch(PDO::FETCH_ASSOC); // permet de récupérer un enregistrement de la BDD sous la forme d'un array associatif
        // Pour récupérer un objet Product pour cet enregistrement
        // => on utilise fetchObject (qui attend le nom de la classe à instancier pour le résultat)
        $product = $statement->fetchObject('\Oshop\Models\Product');
        
        // Je retourne l'objet Product qui contient toutes les données
        // récupérées depuis la base de données
        return $product;
    }

    /**
     * récupérer les produits d'une catégorie
     * 
     * @param int $categoryId : l'identifiant d'une catégorie
     * @param string $sort : tri a effectuer (optionnel)
     * @return Product[]
     */
    public function findAllByCategory($categoryId, $sort = null)
    {

        // définir la colonne à utiliser pour le tri
        switch ($sort) {
            case 'byname':
                $sortColumn = '`product`.`name`';
            break;
            case 'byvote':
                $sortColumn = '`product`.`rate`';
            break;
            case 'bydate':
                $sortColumn = '`product`.`created_at`';
            break;
            default:
                $sortColumn = '`product`.`name`';
        }

        $sql = "
        SELECT
        `product`.*,
        `type`.`name` AS 'type_name'
        FROM `product`
        INNER JOIN `type` ON `product`.`type_id` = `type`.`id` 
        WHERE `category_id` = {$categoryId}
        ORDER BY {$sortColumn}
        ";

        // Je recupere la connexion à la BDD
        $pdo = \Database::getPDO();

        // J'execute la requete
        $statement = $pdo->query($sql);

        // on précise à fetchAll le format des résultats
        $products = $statement->fetchAll(\PDO::FETCH_CLASS, '\OShop\Models\Product');

        return $products;
    }

    /**
     * récupérer les produits d'une marque
     * 
     * @param int $brandId
     * @return Product[]
     */
    public function findAllByBrand($brandId, $sort = null)
    {
        // définir la colonne à utiliser pour le tri
        switch ($sort) {
            case 'byname':
                $sortColumn = '`product`.`name`';
            break;
            case 'byvote':
                $sortColumn = '`product`.`rate`';
            break;
            case 'bydate':
                $sortColumn = '`product`.`created_at`';
            break;
            default:
                $sortColumn = '`product`.`name`';
        }

        $sql = "
        SELECT
        `product`.*,
        `type`.`name` AS type_name
        FROM `product`
        INNER JOIN `type` ON `product`.`type_id` = `type`.`id` 
        WHERE `product`.`brand_id` = {$brandId}
        ORDER BY {$sortColumn}
        ";

        // Je recupere la connexion à la BDD
        $pdo = \Database::getPDO();

        // J'execute la requete
        $statement = $pdo->query($sql);

        // récupérer tous les résultats dans un array qui contient des objets Product
        $products = $statement->fetchAll(\PDO::FETCH_CLASS, '\OShop\Models\Product');

        return $products;
    }
    

    /**
     * récupérer les produits d'un type
     * 
     * @param int $typeId
     * @return Product[]
     */
    public function findAllByType($typeId, $sort = null)
    {
        // définir la colonne à utiliser pour le tri
        switch ($sort) {
            case 'byname':
                $sortColumn = '`product`.`name`';
            break;
            case 'byvote':
                $sortColumn = '`product`.`rate`';
            break;
            case 'bydate':
                $sortColumn = '`product`.`created_at`';
            break;
            default:
                $sortColumn = '`product`.`name`';
        }

        $sql = "
        SELECT
        `product`.*,
        `type`.`name` AS type_name
        FROM `product`
        INNER JOIN `type` ON `product`.`type_id` = `type`.`id` 
        WHERE `product`.`type_id` = {$typeId}
        ORDER BY {$sortColumn}
        ";

        // Je recupere la connexion à la BDD
        $pdo = \Database::getPDO();

        // J'execute la requete
        $statement = $pdo->query($sql);

        // récupérer tous les résultats dans un array qui contient des objets Product
        $products = $statement->fetchAll(\PDO::FETCH_CLASS, '\OShop\Models\Product');

        return $products;
    }

}
