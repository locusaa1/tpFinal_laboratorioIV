<?php

namespace Models;

class Career 
{
    private $idCareer;
    private $description;
    private $active;

    function __construct()
    {
        
    }

    public function getIdCareer()
    {
        return $this->idCareer;
    }

    public function setIdCareer($idCareer)
    {
        $this->idCareer = $idCareer;

        return $this;
    }
 
    public function getDescription()
    {
        return $this->description;
    }
    
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }
    
    public function getActive()
    {
        return $this->active;
    }
    
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

}

?>