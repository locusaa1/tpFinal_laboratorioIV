<?php


namespace DAO;

use DAO\IAdminDAO as IAdminDAO;
use Models\Administrator as Administrator;
use DAO\Connection as Connection;


class AdminDB_DAO implements IAdminDAO
{
    private $connection;
    private $tableName = "admins";

    public function add(Administrator $admin)
    {
        try {

            $query = "insert into " .
                $this->tableNmae .
                "(first_name,last_name,dni,email,phone_number,username,password) 
                values (:first_name, :last_name, :dni, :email, :phone_number, :username, :password);";

            $parameters['first_name'] = $admin->getFirstName();
            $parameters['last_name'] = $admin->getLastName();
            $parameters['dni'] = $admin->getDni();
            $parameters['email'] = $admin->getEmail();
            $parameters['phone_number'] = $admin->getPhoneNumber();
            $parameters['username'] = $admin->getUsername();
            $parameters['password'] = $admin->getPassword();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $exception) {

            throw $exception;
        }
    }

    public function getAll()
    {
        try {

            $adminList = array();

            $query = "select * from " . $this->tableName . ";";

            $this->connection = Connection::GetInsance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {

                $admin = new Administrator();
                $admin->setFirstName($row['first_name']);
                $admin->setLastName($row['last_name']);
                $admin->setDni($row['dni']);
                $admin->setEmail($row['email']);
                $admin->setPhoneNumber($row['phone_number']);
                $admin->setUsername($row['username']);
                $admin->setPassword($row['password']);
                array_push($adminList, $admin);
            }

            return $adminList;
        } catch (Exception $exception) {

            throw $exception;
        }
    }
}