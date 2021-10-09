<?php


namespace Models;


class Enterprise
{
    private $idEnterprise;
    private $name;
    private $cuit;
    private $phoneNumber;
    private $address;

    /**
     * Enterprise constructor.
     */
    public function __construct()
    {

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getCuit()
    {
        return $this->cuit;
    }

    /**
     * @param mixed $cuit
     */
    public function setCuit($cuit): void
    {
        $this->cuit = $cuit;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @param mixed $phoneNumber
     */
    public function setPhoneNumber($phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address): void
    {
        $this->address = $address;
    }


}