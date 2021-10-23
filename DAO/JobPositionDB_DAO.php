<?php

namespace DAO;

use \Exception as Exception;
use DAO\IJobPositionDB_DAO as IJobPositionDB_DAO;
use Models\JobPosition as JobPosition;
use DAO\Connection as Connection;

class JobPositionDB_DAO implements IJobPositionDB_DAO
{
    private $connection;
    private $tableName = "job_positions";

    public function add(JobPosition $jobPosition)
    {
        try {

            $query = "insert into " .
                $this->tableName .
                "(id_job_position, id_career, description)
                values (:id_job_position, :id_career, :description)";           
           
            $parameters['id_job_position'] = $jobPosition->getJobPositionId();
            $parameters['id_career'] = $jobPosition->getCareerId();
            $parameters['description'] = $jobPosition->getDescription();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $exception) {

            throw $exception;
        }
    }

    public function getAll()
    {

        try {

            $jobPositionList = array();

            $query = "select * from " . $this->tableName;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {

                $jobPosition = new JobPosition();
                $jobPosition->setJobPositionId($row['id_job_position']);
                $jobPosition->setCareerId($row['id_career']);
                $jobPosition->setDescription($row['description']);
                array_push($jobPositionList, $jobPosition);
            }
            return $jobPositionList;
        } catch (Exception $exception) {

            throw $exception;
        }
    }

}
