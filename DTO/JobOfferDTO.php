<?php


namespace DTO;

//Data transfer object no es una representación de la estructura en la base de datos.
class JobOfferDTO
{
    private $idJobOffer;
    private $enterpriseName;
    private $careerName;
    private $jobPositionDescription;
    private $startDate;
    private $limitDate;
    private $description;
    private $salary;
    private $flyer;


    /**
     * JobOfferDTO constructor.
     */
    public function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getIdJobOffer()
    {
        return $this->idJobOffer;
    }

    /**
     * @param mixed $idJobOffer
     */
    public function setIdJobOffer($idJobOffer): void
    {
        $this->idJobOffer = $idJobOffer;
    }

    /**
     * @return mixed
     */
    public function getEnterpriseName()
    {
        return $this->enterpriseName;
    }

    /**
     * @param mixed $enterpriseName
     */
    public function setEnterpriseName($enterpriseName): void
    {
        $this->enterpriseName = $enterpriseName;
    }

    /**
     * @return mixed
     */
    public function getCareerName()
    {
        return $this->careerName;
    }

    /**
     * @param mixed $careerName
     */
    public function setCareerName($careerName): void
    {
        $this->careerName = $careerName;
    }

    /**
     * @return mixed
     */
    public function getJobPositionDescription()
    {
        return $this->jobPositionDescription;
    }

    /**
     * @param mixed $jobPositionDescription
     */
    public function setJobPositionDescription($jobPositionDescription): void
    {
        $this->jobPositionDescription = $jobPositionDescription;
    }

    
    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param mixed $startDate
     */
    public function setStartDate($startDate): void
    {
        $this->startDate = $startDate;
    }

    /**
     * @return mixed
     */
    public function getLimitDate()
    {
        return $this->limitDate;
    }

    /**
     * @param mixed $limitDate
     */
    public function setLimitDate($limitDate): void
    {
        $this->limitDate = $limitDate;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getSalary()
    {
        return $this->salary;
    }

    /**
     * @param mixed $salary
     */
    public function setSalary($salary): void
    {
        $this->salary = $salary;
    }

     /**
     * Get the value of flyer
     */ 
    public function getFlyer()
    {
        return $this->flyer;
    }

    /**
     * Set the value of flyer
     *
     * @return  self
     */ 
    public function setFlyer($flyer)
    {
        $this->flyer = $flyer;

        return $this;
    }

    public function completeSetter($idJobOffer, $enterpriseName, $careerName, $jobPositionDescription, $startDate, $limitDate, $description, $salary, $flyer)
    {
        $this->setIdJobOffer($idJobOffer);
        $this->setEnterpriseName($enterpriseName);
        $this->setCareerName($careerName);
        $this->setJobPositionDescription($jobPositionDescription);
        $this->setStartDate($startDate);
        $this->setLimitDate($limitDate);
        $this->setDescription($description);
        $this->setSalary($salary);
        $this->setFlyer($flyer);
    }

   
}