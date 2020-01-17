<?php 

class Category {

    private $id;
    private $name;
    private $subtitle;
    private $picture;
    private $home_order;
    private $created_at;
    private $updated_at;



    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * 
     */ 
    public function setId($id)
    {
        $this->id = $id;

    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * 
     */ 
    public function setName($name)
    {
        $this->name = $name;

    }

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
    public function getHome_order()
    {
        return $this->home_order;
    }

    /**
     * Set the value of home_order
     *
     * 
     */ 
    public function setHome_order($home_order)
    {
        $this->home_order = $home_order;

    }

    /**
     * Get the value of created_at
     */ 
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * 
     */ 
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;

    }

    /**
     * Get the value of updated_at
     */ 
    public function getUpdated_at()
    {
        return $this->updated_at;
    }

    /**
     * Set the value of updated_at
     *
     * 
     */ 
    public function setUpdated_at($updated_at)
    {
        $this->updated_at = $updated_at;

    }

    /**
     * Récupère une categorie dans la base de données
     *par son id
     * 
     */ 
    public function find($id){
        $sql = 'SELECT * FROM `product` WHERE `id` = ' . $id;

        // récupération de la BDD
        $pdo = Database::getPDO();

        // éxécution de la requete
        $statement = $pdo->query($sql);

        $category = $statement->fetchObject('Category');

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
        $categories = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'Category');
        
        // Renvoie le tableau de Products
        return $categories;
    }

}