<?php


namespace DAO;

use \Exception as Exception;
use DAO\IUserDAO as IUserDao;
use Models\User as User;
use DAO\Connection as Connection;

class UserDB_DAO implements IUserDao
{
    private $connection;
    private $tableName = "users";

    public function add(User $user)
    {
        try {

            $query = "insert into " .
                $this->tableName .
                "(email, password, name, user_type)
                values (:email, :password, :name, :user_type)";
            
           
            $parameters['email'] = $user->getEmail();
            $parameters['password'] = $user->getPassword();
            $parameters['name'] = $user->getName();
            $parameters['user_type'] = $user->getUserType();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $exception) {

            throw $exception;
        }
    }

    public function getAll()
    {

        try {

            $userList = array();

            $query = "select * from " . $this->tableName;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {

                $user = new User();
                $user->setIdUser($row['id_user']);
                $user->setEmail($row['email']);
                $user->setPassword($row['password']);
                $user->setName($row['name']);
                $user->setUserType($row['user_type']);
                array_push($userList, $user);
            }
            return $userList;
        } catch (Exception $exception) {

            throw $exception;
        }
    }

    public function getSpecificEmailUser($email)
    {

        try {

            $user = null;

            $query = "select * from " . $this->tableName . " where email = '" . $email . "';";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            if(!empty($resultSet[0])){
            $user = new User();
            $user->setIdUser($resultSet[0]['id_user']);
            $user->setEmail($resultSet[0]['email']);
            $user->setPassword($resultSet[0]['password']);
            $user->setName($resultSet[0]['name']);
            $user->setUserType($resultSet[0]['user_type']);
            }
            

            return $user;
            
        } catch (Exception $exception) {

            throw $exception;
        }
    }
}