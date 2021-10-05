<?php


namespace Models;


class Administrator extends Person
{
    private $idAdmin;
    private $username;
    private $password;

    /**
     * Administrator constructor.
     * @param $idAdmin
     * @param $username
     * @param $password
     */
    public function __construct($idAdmin, $username, $password)
    {
        $this->idAdmin = $idAdmin;
        $this->username = $username;
        $this->password = $password;
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

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }
}