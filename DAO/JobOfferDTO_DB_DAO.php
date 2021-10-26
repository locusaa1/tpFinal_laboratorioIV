<?php


namespace DAO;

use DTO\JobOfferDTO as JobOfferDTO;
use DAO\Connection as Connection;
use Exception as Exception;

class JobOfferDTO_DB_DAO
{
    private $connection;
    private $tableName = "job_offers";

    public function getAllStrings()
    {
        try {

            $jobOfferList = array();

            $query = "select o.id_job_offer as id_job_offer, e.name as enterprise_name, p.description as position_description, u.name as user_name, u.email as user_email, o.start_date, o.limit_date, o.description, o.salary, o.resume, o.cover_letter 
                        from " . $this->tableName . " o inner join enterprises e 
                            on o.id_enterprise = e.id_enterprise inner join job_positions p
                            on o.id_job_position = p.id_job_position left join users u
                            on o.id_user = u.id_user;";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {

                $jobOfferDTO = new JobOfferDTO();
                $jobOfferDTO->setIdJobOffer($row['id_job_offer']);
                $jobOfferDTO->setEnterpriseName($row['enterprise_name']);
                $jobOfferDTO->setJobPositionDescription($row['position_description']);
                $jobOfferDTO->setUserName($row['user_name']);
                $jobOfferDTO->setUserEmail($row['user_email']);
                $jobOfferDTO->setStartDate($row['start_date']);
                $jobOfferDTO->setLimitDate($row['limit_date']);
                $jobOfferDTO->setDescription($row['description']);
                $jobOfferDTO->setSalary($row['salary']);
                $jobOfferDTO->setResume($row['resume']);
                $jobOfferDTO->setCoverLetter($row['cover_letter']);
                array_push($jobOfferList, $jobOfferDTO);
            }
            return $jobOfferList;
        } catch (Exception $exception) {

            throw $exception;
        }
    }
}