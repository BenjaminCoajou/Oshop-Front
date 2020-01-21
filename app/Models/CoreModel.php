<?php

namespace Oshop\Models;

class CoreModel {

    protected $id;
    protected $name;
    protected $created_at;
    protected $updated_at;

     /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
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
     * Get the value of created_at
     */ 
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * 
     */ 
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;        
    }

    /**
     * Get the value of updated_at
     */ 
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set the value of updated_at
     *
     * 
     */ 
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;        
    }
}