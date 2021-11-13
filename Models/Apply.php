<?php

namespace Models;

class Apply 
{
    private $idApply;
    private $idUser;
    private $idJobOffer;
    private $coverLetter;
    private $resume;
    private $banStatus;

    function __construct()
    {
        
    }

    /**
     * Get the value of idApply
     */ 
    public function getIdApply()
    {
        return $this->idApply;
    }

    /**
     * Set the value of idApply
     *
     * @return  self
     */ 
    public function setIdApply($idApply)
    {
        $this->idApply = $idApply;

        return $this;
    }

     /**
     * Get the value of idUser
     */ 
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set the value of idUser
     *
     * @return  self
     */ 
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    
    /**
     * Get the value of idJobOffer
     */ 
    public function getIdJobOffer()
    {
        return $this->idJobOffer;
    }

    /**
     * Set the value of idJobOffer
     *
     * @return  self
     */ 
    public function setIdJobOffer($idJobOffer)
    {
        $this->idJobOffer = $idJobOffer;

        return $this;
    }

    /**
     * Get the value of coverLetter
     */ 
    public function getCoverLetter()
    {
        return $this->coverLetter;
    }

    /**
     * Set the value of coverLetter
     *
     * @return  self
     */ 
    public function setCoverLetter($coverLetter)
    {
        $this->coverLetter = $coverLetter;

        return $this;
    }

    /**
     * Get the value of resume
     */ 
    public function getResume()
    {
        return $this->resume;
    }

    /**
     * Set the value of resume
     *
     * @return  self
     */ 
    public function setResume($resume)
    {
        $this->resume = $resume;

        return $this;
    }

    /**
     * Get the value of banStatus
     */ 
    public function getBanStatus()
    {
        return $this->banStatus;
    }

    /**
     * Set the value of banStatus
     *
     * @return  self
     */ 
    public function setBanStatus($banStatus)
    {
        $this->banStatus = $banStatus;

        return $this;
    }

}

?>