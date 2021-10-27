<?php


namespace DTO;

//Data transfer object no es una representación de la estructura en la base de datos.
class JobOfferDTO
{
    private $idJobOffer;
    private $enterpriseName;
    private $jobPositionDescription;
    private $userName;
    private $userEmail;
    private $startDate;
    private $limitDate;
    private $description;
    private $salary;
    private $resume;
    private $coverLetter;

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
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param mixed $userName
     */
    public function setUserName($userName): void
    {
        $this->userName = $userName;
    }

    /**
     * @return mixed
     */
    public function getUserEmail()
    {
        return $this->userEmail;
    }

    /**
     * @param mixed $userEmail
     */
    public function setUserEmail($userEmail): void
    {
        $this->userEmail = $userEmail;
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
     * @return mixed
     */
    public function getResume()
    {
        return $this->resume;
    }

    /**
     * @param mixed $resume
     */
    public function setResume($resume): void
    {
        $this->resume = $resume;
    }

    /**
     * @return mixed
     */
    public function getCoverLetter()
    {
        return $this->coverLetter;
    }

    /**
     * @param mixed $coverLetter
     */
    public function setCoverLetter($coverLetter): void
    {
        $this->coverLetter = $coverLetter;
    }

    public function completeSetter($idJobOffer, $enterpriseName, $jobPositionDescription, $userName, $userEmail, $startDate, $limitDate, $description, $salary, $resume, $coverLetter)
    {
        $this->setIdJobOffer($idJobOffer);
        $this->setEnterpriseName($enterpriseName);
        $this->setJobPositionDescription($jobPositionDescription);
        $this->setUserName($userName);
        $this->setUserEmail($userEmail);
        $this->setStartDate($startDate);
        $this->setLimitDate($limitDate);
        $this->setDescription($description);
        $this->setSalary($salary);
        $this->setResume($resume);
        $this->setCoverLetter($coverLetter);
    }
}