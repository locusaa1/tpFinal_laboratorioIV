<?php


namespace DAO;

use Models\JobOffer as JobOffer;
use DAO\Connection as Connection;
use Exception as Exception;

class JobOfferDB_DAO
{
    private $connection;
    private $tableName = "job_offers";

    public function add(JobOffer $jobOffer)
    {
        try {

            $query = "insert into " .
                $this->tableName .
                "(id_job_offer, id_job_position, id_enterprise, start_date, limit_date, description, salary, flyer) 
                values (:id_job_offer, :id_job_position, :id_enterprise, :start_date, :limit_date, :description, :salary, :flyer);";

            $parameters['id_job_offer'] = $jobOffer->getIdJobOffer();
            $parameters['id_job_position'] = $jobOffer->getIdJobPosition();
            $parameters['id_enterprise'] = $jobOffer->getIdEnterprise();
            $parameters['start_date'] = date('Y-m-d',strtotime($jobOffer->getStartDate()));
            $parameters['limit_date'] = date('Y-m-d',strtotime($jobOffer->getLimitDate()));
            $parameters['description'] = $jobOffer->getDescription();
            $parameters['salary'] = $jobOffer->getSalary();
            $parameters['flyer'] = $jobOffer->getFlyer();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $exception) {

            throw $exception;
        }
    }

    public function getAll()
    {
        try {

            $jobOfferList = array();

            $query = "select * from " . $this->tableName . ";";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {

                $jobOffer = new JobOffer();
                $jobOffer->setIdJobOffer($row['id_job_offer']);
                $jobOffer->setIdJobPosition($row['id_job_position']);
                $jobOffer->setIdEnterprise($row['id_enterprise']);
                $jobOffer->setStartDate($row['start_date']);
                $jobOffer->setLimitDate($row['limit_date']);
                $jobOffer->setDescription($row['description']);
                $jobOffer->setSalary($row['salary']);
                $jobOffer->setFlyer($row['flyer']);
                array_push($jobOfferList, $jobOffer);
            }

            return $jobOfferList;
        } catch (Exception $exception) {

            throw $exception;
        }
    }

    public function getSpecificJobOfferById($idJobOffer)
    {
        try {

            $jobOfferFound = new JobOffer();

            $query = "select * from " . $this->tableName . " where id_job_offer = " . $idJobOffer . ";";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            $jobOfferFound->setIdJobOffer($resultSet[0]['id_job_offer']);
            $jobOfferFound->setIdJobPosition($resultSet[0]['id_job_position']);
            $jobOfferFound->setIdEnterprise($resultSet[0]['id_enterprise']);
            $jobOfferFound->setStartDate($resultSet[0]['start_date']);
            $jobOfferFound->setLimitDate($resultSet[0]['limit_date']);
            $jobOfferFound->setDescription($resultSet[0]['description']);
            $jobOfferFound->setSalary($resultSet[0]['salary']);
            $jobOfferFound->setFlyer($resultSet[0]['flyer']);

            return $jobOfferFound;
        } catch (Exception $exception) {

            throw $exception;
        }
    }

    public function updateJobOffer(JobOffer $updateJobOffer)
    {
        try {

            $query = "update " . $this->tableName . " set " .
                "id_job_offer = " . $updateJobOffer->getIdJobOffer() . ",
                id_job_position = " . $updateJobOffer->getIdJobPosition() . ",
                id_enterprise = " . $updateJobOffer->getIdEnterprise() . ",
                start_date = '" . date('Y-m-d', strtotime($updateJobOffer->getStartDate())) . "',
                limit_date = '" . date('Y-m-d', strtotime($updateJobOffer->getLimitDate())) . "',
                flyer = '" . $updateJobOffer->getFlyer() . "',
                description = '" . $updateJobOffer->getDescription() . "',
                salary = '" . $updateJobOffer->getSalary() . "' where id_job_offer = '" . $updateJobOffer->getIdJobOffer() . "';";

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query);
        } catch (Exception $exception) {

            throw $exception;
        }
    }

    public function deleteJobOffer($idJobOffer)
    {
        try {

            $query = "delete from " . $this->tableName . " where id_job_offer ='" . $idJobOffer . "';";

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query);
        } catch (Exception $exception) {

            throw $exception;
        }
    }


}