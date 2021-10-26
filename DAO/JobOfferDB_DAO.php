<?php


namespace DAO;

use Models\JobOffer as JobOffer;
use Models\JobOfferStrings as JobOfferStrings;
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

    public function getAllStrings()
    {
        try {

            $jobOfferList = array();

            $query = "select e.name as enterprise_name, p.description as position_description, u.name as user_name, u.email as user_email, o.start_date, o.limit_date, o.description, o.salary, o.resume, o.cover_letter 
                        from " . $this->tableName . " o inner join enterprises e 
                            on o.id_enterprise = e.id_enterprise inner join job_positions p
                            on o.id_job_position = p.id_job_position left join users u
                            on o.id_user = u.id_user;";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {

                $jobOffer = new JobOfferStrings();
                $jobOffer->setEnterpriseName($row['enterprise_name']);
                $jobOffer->setJobPositionDescription($row['position_description']);
                $jobOffer->setUserName($row['user_name']);
                $jobOffer->setUserEmail($row['user_email']);
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