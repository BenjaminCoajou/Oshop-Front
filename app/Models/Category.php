<?php 

namespace Oshop\Models;

use \Oshop\Utils\Database;

class Category extends CoreModel {

    private $subtitle;
    private $picture;
    private $home_order;
    

    

    /**
     * Get the value of subtitle
     */ 
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * Set the value of subtitle
     *
     * 
     */ 
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;

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
     * Get the value of home_order
     */ 
    public function getHomeOrder()
    {
        return $this->home_order;
    }

    /**
     * Set the value of home_order
     *
     * 
     */ 
    public function setHomeOrder($home_order)
    {
        $this->home_order = $home_order;

    }

   
    /**
     * Récupère une categorie dans la base de données
     *par son id
     * 
     */ 
    public function find($categoryId){
        $sql = 'SELECT * FROM `category` WHERE `id` = ' . $categoryId;

        // récupération de la BDD
        $pdo = Database::getPDO();

        // éxécution de la requete
        $statement = $pdo->query($sql);

        $category = $statement->fetchObject(Category::class);

        // Retour de l'objet Category qui contient toutes les données récupérées depuis la BDD
        return $category;
    }
    public function findAll() {
        $sql = '
            SELECT * FROM `category`
        ';
        // Database::getPDO() me retourne l'objet PDO représentant la connexion à la BDD
        $pdo = Database::getPDO();
        // j'execute ma requête pour récupérer les Products
        $pdoStatement = $pdo->query($sql);
        // fetchAll avec l'argument FETCH_CLASS renvoie un array qui contient tous mes résultats sous la forme d'objets de la classe spécifiée en 2e argument
        $categories = $pdoStatement->fetchAll(\PDO::FETCH_CLASS, Category :: class);
        
        // Renvoie le tableau de Products
        return $categories;
    }

    public function findAllForHome() {
        $sql = "SELECT * 
        FROM `category` 
        WHERE `home_order` > 0 ORDER BY `home_order`
        ";

        $pdo = Database::getPDO();

        $statement = $pdo->query($sql);

        $categories = $statement->fetchAll(\PDO::FETCH_CLASS, Category :: class);

        return $categories;
    }
}