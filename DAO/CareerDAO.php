<?php

namespace DAO;

use \Exception as Exception;
use DAO\ICareerDAO as ICareerDAO;
use Models\Career as Career;
use DAO\Connection as Connection;

class CareerDAO implements ICareerDAO
{
    private $connection;
    private $tableName = "careers";
    private $careerList = array();


    public function getAllFromApi()
    {
        $this->RetrieveDataFromApi();

        return $this->careerList;
    }

    /*this function looks for the careers in the list, if it finds it returns it*/
    public function GetByDescription($description) 
    {
        $this->RetrieveDataFromApi();  
        $careerFounded = null;
        
        if(!empty($this->careerList)){
            foreach($this->careerList as $career){
                if($career->getDescription() == $description){
                    $careerFounded = $career;
                }
            }
        }

        return $careerFounded;
    }

    /* this function brings the information of the career´s api through a curl handler. Then
    load the list with the obtained career objects*/
    private function RetrieveDataFromApi()
    {
        $this->careerList = array();

        $ch = curl_init();

        $url = "https://utn-students-api.herokuapp.com/api/Career";

        $header = array (
            'x-api-key: 4f3bceed-50ba-4461-a910-518598664c08'
        );

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        $response = curl_exec($ch);

        $arrayToDecode = json_decode ($response, true);

        foreach($arrayToDecode as $valuesArray)
        {
            $career= new Career();
            $career->setIdCareer($valuesArray["careerId"]);
            $career->setDescription($valuesArray["description"]);
            $career->setActive($valuesArray["active"]);
            
            array_push($this->careerList, $career);
        }

    }

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

    public function getAllFromDB()
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
