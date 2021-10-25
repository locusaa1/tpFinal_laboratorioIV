<?php

namespace DAO;

use \Exception as Exception;
use DAO\IJobPositionDAO as IJobPositionDAO;
use Models\JobPosition as JobPosition;
use DAO\Connection as Connection;

class JobPositionDAO implements IJobPositionDAO
{
    private $connection;
    private $tableName = "job_positions";
    private $jobPositionList = array();

    public function getAllFromApi()
    {
        $this->RetrieveDataFromApi();

        return $this->jobPositionList;
    }

    /* this function brings the information of the job position´s api through a curl handler. Then
    load the list with the obtained job_position objects*/
    private function RetrieveDataFromApi()
    {
        $this->jobPositionList = array();

        $ch = curl_init();

        $url = "https://utn-students-api.herokuapp.com/api/JobPosition";

        $header = array 
        (
            'x-api-key: 4f3bceed-50ba-4461-a910-518598664c08'
        );

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        $response = curl_exec($ch);

        $arrayToDecode = json_decode ($response, true);

        foreach($arrayToDecode as $valuesArray)
        {
            $jobPosition= new JobPosition();
            $jobPosition->setJobPositionId($valuesArray["jobPositionId"]);
            $jobPosition->setCareerId($valuesArray["careerId"]);
            $jobPosition->setDescription($valuesArray["description"]);
                
            array_push($this->jobPositionList, $jobPosition);
        }

    }

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

    public function getAllFromDB()
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

    public function jobPositionsByCareer ($idCareer)
    {
        try {

            $jobPositionByCareerList = array();

            $query = "select * from " . $this->tableName . " where id_career = " . $idCareer . ";";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {

                $jobPosition = new JobPosition();
                $jobPosition->setJobPositionId($row['id_job_position']);
                $jobPosition->setCareerId($row['id_career']);
                $jobPosition->setDescription($row['description']);
                array_push($jobPositionList, $jobPosition);
            }
        
            return $jobPositionByCareerList;
        
            
        } catch (Exception $exception) {

            throw $exception;
        }

    }

}
