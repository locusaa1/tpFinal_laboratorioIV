<?php

namespace DAO;

use \Exception as Exception;
use DAO\ICareerDB_DAO as ICareerDB_DAO;
use Models\Career as Career;
use DAO\Connection as Connection;

class CareerDB_DAO implements ICareerDB_DAO
{
    private $connection;
    private $tableName = "careers";

    public function add(Career $career)
    {
        try {

            $query = "insert into " .
                $this->tableName .
                "(id_career, name, active)
                values (:id_career, :name, :active)";           
           
            $parameters['id_career'] = $career->getIdCareer();
            $parameters['name'] = $career->getDescription();
            $parameters['active'] = $career->getActive();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $exception) {

            throw $exception;
        }
    }

    public function getAll()
    {

        try {

            $careerList = array();

            $query = "select * from " . $this->tableName;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {

                $career = new Career();
                $career->setIdCareer($row['id_career']);
                $career->setDescription($row['name']);
                $career->setActive($row['active']);
                array_push($careerList, $career);
            }
            return $careerList;
        } catch (Exception $exception) {

            throw $exception;
        }
    }

}
