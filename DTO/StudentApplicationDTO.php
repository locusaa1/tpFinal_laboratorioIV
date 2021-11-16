<?php


namespace DTO;

//Data transfer object no es una representación de la estructura en la base de datos.
class StudentApplicationDTO
{
    private $idJobOffer;
    private $studentName;
    private $studentAge;
    private $studentEmail;
    private $studentPhone;
    private $coverLetter;
    private $resume;
    private $banStatus;

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
     * Get the value of studentName
     */ 
    public function getStudentName()
    {
        return $this->studentName;
    }

    /**
     * Set the value of studentName
     *
     * @return  self
     */ 
    public function setStudentName($studentName)
    {
        $this->studentName = $studentName;

        return $this;
    }

    /**
     * Get the value of studentAge
     */ 
    public function getStudentAge()
    {
        return $this->studentAge;
    }

    /**
     * Set the value of studentAge
     *
     * @return  self
     */ 
    public function setStudentAge($studentAge)
    {
        $this->studentAge = $studentAge;

        return $this;
    }

    /**
     * Get the value of studentEmail
     */ 
    public function getStudentEmail()
    {
        return $this->studentEmail;
    }

    /**
     * Set the value of studentEmail
     *
     * @return  self
     */ 
    public function setStudentEmail($studentEmail)
    {
        $this->studentEmail = $studentEmail;

        return $this;
    }

    /**
     * Get the value of studentPhone
     */ 
    public function getStudentPhone()
    {
        return $this->studentPhone;
    }

    /**
     * Set the value of studentPhone
     *
     * @return  self
     */ 
    public function setStudentPhone($studentPhone)
    {
        $this->studentPhone = $studentPhone;

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

    public function completeSetter($idJobOffer, $studentName, $studentAge, $studentEmail, $studentPhone, $coverLetter, $resume, $banStatus)
    {
        $this->setIdJobOffer($idJobOffer);
        $this->setStudentName($studentName);
        $this->setStudentAge($studentAge);
        $this->setStudentEmail($studentEmail);
        $this->setStudentPhone($studentPhone);
        $this->setCoverLetter($coverLetter);
        $this->setResume($resume);
        $this->setBanStatus($banStatus);
    }

  
}