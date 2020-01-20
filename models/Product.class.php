<?php

class Product extends CoreModel {

    private $description;
    private $picture;
    private $price;
    private $rate;
    private $status;
    private $brand_id;
    private $category_id;
    private $type_id;
    private $brand_name;
    private $type_name;
    private $category_name;
   


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
     * 
     */ 
    public function setBrand_id($brand_id)
    {
        $this->brand_id = $brand_id;        
    }

    /**
     * Get the value of category_id
     */ 
    public function getCategory_id()
    {
        return $this->category_id;
    }

    /**
     * Set the value of category_id
     *
     * 
     */ 
    public function setCategory_id($category_id)
    {
        $this->category_id = $category_id;        
    }

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
     * 
     */ 
    public function setType_id($type_id)
    {
        $this->type_id = $type_id;        
    }

    /**
     * Récupère un produit dans la base de données
     *par son id
     * 
     */ 

    /**
     * Get the value of brand_name
     */ 
    public function getBrand_name()
    {
        return $this->brand_name;
    }
    
    /**
     * Get the value of type_name
     */ 
    public function getType_name()
    {
        return $this->type_name;
    }
    
    /**
     * Get the value of category_name
     */ 
    public function getCategory_name()
    {
        return $this->category_name;
    }

    public function find($productId){
        $sql = "SELECT 
        `product`.*, `brand`.`name` AS 'brand_name', `category`.`name` AS 'category_name' 
        FROM `product` 
        INNER JOIN `brand` ON `product`.`brand_id` = `brand`.`id` 
        INNER JOIN `category` ON `product`.`category_id` = `category`.`id` 
        WHERE `product`.`id` = {$productId}";

        // récupération de la BDD
        $pdo = Database::getPDO();

        // éxécution de la requete
        $statement = $pdo->query($sql);

        $product = $statement->fetchObject('Product');
        //dump($product);
        //exit;
        // Retour de l'objet Product qui contient toutes les données récupérées depuis la BDD
        return $product;
    }

    public function findAll() {
        $sql = '
            SELECT * FROM `product`
        ';
        // Database::getPDO() me retourne l'objet PDO représentant la connexion à la BDD
        $pdo = Database::getPDO();
        // j'execute ma requête pour récupérer les Products
        $pdoStatement = $pdo->query($sql);
        // fetchAll avec l'argument FETCH_CLASS renvoie un array qui contient tous mes résultats sous la forme d'objets de la classe spécifiée en 2e argument
        $products = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'Product');
        
        // Renvoie le tableau de Products
        return $products;
    }

    public function findAllByCategory($categoryId){
        $sql = "SELECT 
        `product`.*, 
        `type`.`name` AS 'type_name'
        FROM `product` 
        INNER JOIN `type` ON `product`.`type_id` = `type`.`id`
        WHERE `product`.`category_id` = {$categoryId}
        ";

        $pdo = Database::getPDO();

        $statement = $pdo->query($sql);

        $products = $statement->fetchAll(PDO::FETCH_CLASS, 'Product');

        return $products;
    }

    public function findAllByBrand($brandId){
        $sql = "SELECT 
        `product`.*, 
        `type`.`name` AS 'type_name'
        FROM `product` 
        INNER JOIN `type` ON `product`.`type_id` = `type`.`id`
        WHERE `product`.`brand_id` = {$brandId}
        ";

        $pdo = Database::getPDO();

        $statement = $pdo->query($sql);

        $products = $statement->fetchAll(PDO::FETCH_CLASS, 'Product');

        return $products;
    }

    public function findAllByType($typeId){
        $sql = "SELECT 
        `product`.*, 
        `type`.`name` AS 'type_name'
        FROM `product` 
        INNER JOIN `type` ON `product`.`type_id` = `type`.`id`
        WHERE `product`.`type_id` = {$typeId}
        ";

        $pdo = Database::getPDO();

        $statement = $pdo->query($sql);

        $products = $statement->fetchAll(PDO::FETCH_CLASS, 'Product');

        return $products;
    }


}