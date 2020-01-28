<?php

namespace OShop\Models;

class Type extends CoreModel {

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

    public function find($typeId)
    {
         // Je construis ma requete
         $sql = "
         SELECT * FROM `type` WHERE `id` = {$typeId}
         ";
 
         // Je recupere la connexion à la BDD
         $pdo = \Database::getPDO();
 
         // J'execute la requete
         $statement = $pdo->query($sql);
 
         // Je recupère le resultat
         $type = $statement->fetchObject('\OShop\Models\Type');
         
         // Je retourne l'objet 
         return $type;
    }

    public function findAllForFooter()
    {
        $sql = "
        SELECT * FROM `type` WHERE `footer_order` > 0 ORDER BY `footer_order`
        ";

        // Je recupere la connexion à la BDD
        $pdo = \Database::getPDO();

        // J'execute la requete
        $statement = $pdo->query($sql);

        // on précise à fetchAll le format des résultats
        $types = $statement->fetchAll(\PDO::FETCH_CLASS, '\OShop\Models\Type');

        return $types;
    }
}
