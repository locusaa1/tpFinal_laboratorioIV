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
                "(id_job_offer, id_job_position, id_enterprise, id_user, start_date, limit_date, description, salary, resume, cover_letter) 
                values (:id_job_offer, :id_job_position, :id_enterprise, :id_user, :start_date, :limit_date, :description, :salary, :resume, :cover_letter);";

            $parameters['id_job_offer'] = $jobOffer->getIdJobOffer();
            $parameters['id_job_position'] = $jobOffer->getIdJobPosition(); //jobOffer->getPosition()->getId();
            $parameters['id_enterprise'] = $jobOffer->getIdEnterprise();
            $parameters['id_user'] = $jobOffer->getIdUser();
            $parameters['start_date'] = $jobOffer->getStartDate();
            $parameters['limit_date'] = $jobOffer->getLimitDate();
            $parameters['description'] = $jobOffer->getDescription();
            $parameters['salary'] = $jobOffer->getSalary();
            $parameters['resume'] = $jobOffer->getResume();
            $parameters['cover_letter'] = $jobOffer->getCoverLetter();

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
                $jobOffer->setIdUser($row['id_user']);
                $jobOffer->setStartDate($row['start_date']);
                $jobOffer->setLimitDate($row['limit_date']);
                $jobOffer->setDescription($row['description']);
                $jobOffer->setSalary($row['salary']);
                $jobOffer->setResume($row['resume']);
                $jobOffer->setCoverLetter($row['cover_letter']);
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
            $jobOfferFound->setIdUser($resultSet[0]['id_user']);
            $jobOfferFound->setStartDate($resultSet[0]['start_date']);
            $jobOfferFound->setLimitDate($resultSet[0]['limit_date']);
            $jobOfferFound->setDescription($resultSet[0]['description']);
            $jobOfferFound->setSalary($resultSet[0]['salary']);
            $jobOfferFound->setResume($resultSet[0]['resume']);
            $jobOfferFound->setCoverLetter($resultSet[0]['cover_letter']);

            return $jobOfferFound;
        } catch (Exception $exception) {

            throw $exception;
        }
    }

    public function updateJobOffer(JobOffer $updateJobOffer)
    {
        try {

            $query = "update ". $this->tableName . " set ".
                "id_job_offer = '".$updateJobOffer->getIdJobOffer() ."',
                id_job_position = '". $updateJobOffer->getIdJobPosition()."',
                id_enterprise = '".$updateJobOffer->getIdEnterprise()."',
                "
        }
    }
}