<?php

class Type{
    private $id;
    private $name;
    private $footer_order;
    private $created_at;
    private $update_at;

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
     * Get the value of footer_order
     */ 
    public function getFooter_order()
    {
        return $this->footer_order;
    }

    /**
     * Set the value of footer_order
     *
     *
     */ 
    public function setFooter_order($footer_order)
    {
        $this->footer_order = $footer_order;

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
     * Get the value of update_at
     */ 
    public function getUpdate_at()
    {
        return $this->update_at;
    }

    /**
     * Set the value of update_at
     *
     *
     */ 
    public function setUpdate_at($update_at)
    {
        $this->update_at = $update_at;

    }

    public function find($id){
        $sql = 'SELECT * FROM `type` WHERE `id` = ' . $id;

        // récupération de la BDD
        $pdo = Database::getPDO();

        // éxécution de la requete
        $statement = $pdo->query($sql);

        $type = $statement->fetchObject('Type');
        //dump($product);
        //exit;
        // Retour de l'objet Product qui contient toutes les données récupérées depuis la BDD
        return $type;
    }

    public function findAll() {
        $sql = '
            SELECT * FROM `type`
        ';
        // Database::getPDO() me retourne l'objet PDO représentant la connexion à la BDD
        $pdo = Database::getPDO();
        // j'execute ma requête pour récupérer les Products
        $pdoStatement = $pdo->query($sql);
        // fetchAll avec l'argument FETCH_CLASS renvoie un array qui contient tous mes résultats sous la forme d'objets de la classe spécifiée en 2e argument
        $types = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'Type');
        
        // Renvoie le tableau de Products
        return $types;
    }

}