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

    
}