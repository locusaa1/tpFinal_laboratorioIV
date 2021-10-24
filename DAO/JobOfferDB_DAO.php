<?php


namespace DAO;

use Models\JobOffer as JobOffer;
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


}