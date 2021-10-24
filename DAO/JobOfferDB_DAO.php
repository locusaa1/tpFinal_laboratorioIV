<?php


namespace DAO;

use Models\JobOffer as JobOffer;
use DAO\Connection as Connection;
use Exception as Exception;

class JobOfferDB_DAO
{
    private $connection;
    private $tableName;

    public function add(JobOffer $jobOffer)
    {
        try {

            $query = "insert into " .
                $this->tableName .
                "(id_job_offer, id_job_position, id_enterprise, id_user, start_date, limit_date, description, salary, resume, cover_letter) 
                values (:id_job_offer, :id_job_position, :id_enterprise, :id_user, :start_date, :limit_date, :description, :salary, :resume, :cover_letter);";

            $parameters['id_job_offer'] = $jobOffer->getIdJobOffer();
            $parameters['id_job_position'] = $jobOffer->getIdJobPosition();
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
}