<?php

namespace OShop\Models;

// CoreModel sera inteprété par PHP comme OShop\Models\CordeModel (à cause du namespace de ce fichier Category.php - namespace Courant)
// donc OK puisque CoreModel appartient bien à ce Namespace
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
     * @return  self
     */ 
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;

        return $this;
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
     * @return  self
     */ 
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
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
     * @return  self
     */ 
    public function setHomeOrder($home_order)
    {
        $this->home_order = $home_order;

        return $this;
    }

    public function find($categoryId)
    {
         // Je construis ma requete
         $sql = "
         SELECT * FROM `category` WHERE `id` = {$categoryId}
         ";
 
         // Je recupere la connexion à la BDD
         $pdo = \Database::getPDO();
 
         // J'execute la requete
         $statement = $pdo->query($sql);
 
         // Je recupère le resultat
         $category = $statement->fetchObject('\Oshop\Models\Category');
         
         // Je retourne l'objet 
         return $category;
    }

    public function findAllForHome()
    {
        $sql = "
        SELECT * FROM `category` WHERE `home_order` > 0 ORDER BY `home_order`
        ";

        // Je recupere la connexion à la BDD
        $pdo = \Database::getPDO();

        // J'execute la requete
        $statement = $pdo->query($sql);

        // on précise à fetchAll le format des résultats
        $categories = $statement->fetchAll(\PDO::FETCH_CLASS, '\Oshop\Models\Category');

        return $categories;
    }
}
