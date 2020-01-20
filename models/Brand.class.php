<?php

class Brand extends CoreModel{
   
    private $footer_order;
    

   
    /**
     * Get the value of footer_order
     */ 
    public function getFooterOrder()
    {
        return $this->footer_order;
    }

    /**
     * Set the value of footer_order
     *
     *
     */ 
    public function setFooterOrder($footer_order)
    {
        $this->footer_order = $footer_order;

    }

    

     /**
     * Récupère une marque dans la base de données
     *par son id
     * 
     */ 
    public function find($brandId){
        $sql = 'SELECT * FROM `brand` WHERE `id` = ' . $brandId;

        // récupération de la BDD
        $pdo = Database::getPDO();

        // éxécution de la requete
        $statement = $pdo->query($sql);

        $brand = $statement->fetchObject('Brand');

        // Retour de l'objet Category qui contient toutes les données récupérées depuis la BDD
        return $brand;
    }

    public function findAll() {
        $sql = '
            SELECT * FROM `brand`
        ';
        // Database::getPDO() me retourne l'objet PDO représentant la connexion à la BDD
        $pdo = Database::getPDO();
        // j'execute ma requête pour récupérer les Products
        $pdoStatement = $pdo->query($sql);
        // fetchAll avec l'argument FETCH_CLASS renvoie un array qui contient tous mes résultats sous la forme d'objets de la classe spécifiée en 2e argument
        $brands = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'Brand');
        
        // Renvoie le tableau de Products
        return $brands;
    }

    public function findAllForFooter() {
        $sql = "SELECT * 
        FROM `brand` 
        WHERE `footer_order` > 0 ORDER_BY `footer_order`
        ";

        $pdo = Database::getPDO();

        $statement = $pdo->query($sql);

        $brands = $statement->fetchAll(PDO::FETCH_CLASS, 'Brand');

        return $brands;
    }

}