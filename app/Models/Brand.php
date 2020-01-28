<?php

// ce fichier appartient à un namespace donné
namespace OShop\Models;

class Brand extends CoreModel {

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
     * @return  self
     */ 
    public function setFooterOrder($footer_order)
    {
        $this->footer_order = $footer_order;

        return $this;
    }

    public function find($brandId)
    {
         // Je construis ma requete
         $sql = "
         SELECT * FROM `brand` WHERE `id` = {$brandId}
         ";
 
         // Je recupere la connexion à la BDD
         $pdo = \Database::getPDO();
 
         // J'execute la requete
         $statement = $pdo->query($sql);
 
         // Je recupère le resultat
         $brand = $statement->fetchObject('\OShop\Models\Brand');
         
         // Je retourne l'objet 
         return $brand;
    }

    public function findAllForFooter()
    {
        $sql = "
        SELECT * FROM `brand` WHERE `footer_order` > 0 ORDER BY `footer_order`
        ";

        // Je recupere la connexion à la BDD
        $pdo = \Database::getPDO();

        // J'execute la requete
        $statement = $pdo->query($sql);

        // on précise à fetchAll le format des résultats
        $brands = $statement->fetchAll(\PDO::FETCH_CLASS, '\OShop\Models\Brand');

        return $brands;
    }
}
