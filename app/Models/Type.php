<?php

namespace Oshop\Models;

use \Oshop\Utils\Database;

class Type extends CoreModel{
    
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

    public function find($typeId){
        $sql = 'SELECT * FROM `type` WHERE `id` = ' . $typeId;

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
        $types = $pdoStatement->fetchAll(\PDO::FETCH_CLASS, Type :: class);
        
        // Renvoie le tableau de Products
        return $types;
    }

    public function findAllForFooter() {
        $sql = "SELECT * 
        FROM `type` 
        WHERE `footer_order` > 0 ORDER BY `footer_order`
        ";

        $pdo = Database::getPDO();

        $statement = $pdo->query($sql);

        $types = $statement->fetchAll(\PDO::FETCH_CLASS, Type :: class);

        return $types;
    }
}