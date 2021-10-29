<?php


namespace DAO;

use DAO\IAdminDAO as IAdminDAO;
use Models\Administrator as Administrator;
use DAO\Connection as Connection;
use Exception as Exception;


class AdminDB_DAO implements IAdminDAO
{
    private $connection;
    private $tableName = "admins";

    public function add(Administrator $admin)
    {
        try {

            $query = "insert into " .
                $this->tableName .
                "(first_name,last_name,dni,birth_date,gender,email,phone_number) 
                values (:first_name,:last_name,:dni,:birth_date,:gender,:email,:phone_number);";

            $parameters['first_name'] = $admin->getFirstName();
            $parameters['last_name'] = $admin->getLastName();
            $parameters['dni'] = $admin->getDni();
            $parameters['birth_date'] = $admin->getBirthDate();
            $parameters['gender'] = $admin->getGender();
            $parameters['email'] = $admin->getEmail();
            $parameters['phone_number'] = $admin->getPhoneNumber();

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

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {

                $admin = new Administrator();
                $admin->setIdAdmin($row['id_admin']);
                $admin->setFirstName($row['first_name']);
                $admin->setLastName($row['last_name']);
                $admin->setDni($row['dni']);
                $admin->setBirthDate($row['birth_date']);
                $admin->setGender($row['gender']);
                $admin->setEmail($row['email']);
                $admin->setPhoneNumber($row['phone_number']);
                array_push($adminList, $admin);
            }

            return $adminList;
        } catch (Exception $exception) {

            throw $exception;
        }
    }

    public function getAdminByEmail($email)
    {
        try {

            $adminFound = null;

            $query = "select * from " . $this->tableName . " where email = '" . $email . "';";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            if (!empty($resultSet[0])) {

                $adminFound = new Administrator();
                $adminFound->setIdAdmin($resultSet[0]['id_admin']);
                $adminFound->setFirstName($resultSet[0]['first_name']);
                $adminFound->setLastName($resultSet[0]['last_name']);
                $adminFound->setDni($resultSet[0]['dni']);
                $adminFound->setBirthDate($resultSet[0]['birth_date']);
                $adminFound->setGender($resultSet[0]['gender']);
                $adminFound->setEmail($resultSet[0]['email']);
                $adminFound->setPhoneNumber($resultSet[0]['phone_number']);
            }
            return $adminFound;
        } catch (Exception $exception) {

            throw $exception;
        }
    }
}










