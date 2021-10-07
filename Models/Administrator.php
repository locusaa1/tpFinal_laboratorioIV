<?php


namespace Models;

use Models\Person as Person;

class Administrator extends Person
{
    private $idAdmin;
    private $username;
    private $password;

    /**
     * Administrator constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->idAdmin = random_bytes(10);
    }

    /**
     * @return mixed
     */
    public function getIdAdmin()
    {
        return $this->idAdmin;
    }

    /**
     * @param mixed $idAdmin
     */
    public function setIdAdmin($idAdmin)
    {
        $this->idAdmin = $idAdmin;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
}