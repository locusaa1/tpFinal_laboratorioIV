<?php


namespace DAO;

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
                "(email, password, `name`, userType)
                values (:email, :password, :`name`, :userType)";

            $parameters['email'] = $user->getEmail();
            $parameters['password'] = $user->getPassword();
            $parameters['name'] = $user->getName();
            $parameters['userType'] = $user->getUserType();

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
                $user->setPassword($row['name']);
                $user->setUserType($row['user_type']);
                array_push($userList, $user);
            }
            return $userList;
        } catch (Exception $exception) {

            throw $exception;
        }
    }
}