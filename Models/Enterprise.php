<?php


namespace Models;


class Enterprise
{
    private $idEnterprise;
    private $name;
    private $cuit;
    private $phoneNumber;
    private $addressName;
    private $addressNumber;

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
    public function getAddressName()
    {
        return $this->addressName;
    }

    /**
     * @param mixed $addressName
     */
    public function setAddressName($addressName): void
    {
        $this->addressName = $addressName;
    }

    /**
     * @return mixed
     */
    public function getAddressNumber()
    {
        return $this->addressNumber;
    }

    /**
     * @param mixed $addressNumber
     */
    public function setAddressNumber($addressNumber): void
    {
        $this->addressNumber = $addressNumber;
    }
}