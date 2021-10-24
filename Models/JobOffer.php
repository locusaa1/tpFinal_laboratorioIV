<?php


namespace Models;


class JobOffer
{
    private $idJobOffer;
    private $idJobPosition;
    private $idEnterprise;
    private $idUser;
    private $startDate;
    private $limitDate;
    private $description;
    private $salary;
    private $resume;
    private $coverLetter;

    /**
     * JobOffer constructor.
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
    public function getIdJobPosition()
    {
        return $this->idJobPosition;
    }

    /**
     * @param mixed $idJobPosition
     */
    public function setIdJobPosition($idJobPosition): void
    {
        $this->idJobPosition = $idJobPosition;
    }

    /**
     * @return mixed
     */
    public function getIdEnterprise()
    {
        return $this->idEnterprise;
    }

    /**
     * @param mixed $idEnterprise
     */
    public function setIdEnterprise($idEnterprise): void
    {
        $this->idEnterprise = $idEnterprise;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @param mixed $idUser
     */
    public function setIdUser($idUser): void
    {
        $this->idUser = $idUser;
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


}