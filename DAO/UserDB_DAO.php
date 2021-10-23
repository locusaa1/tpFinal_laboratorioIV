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
}