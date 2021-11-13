<?php

namespace DAO;

use \Exception as Exception;
use DAO\IApplyDAO as IApplyDAO;
use Models\Apply as Apply;
use DAO\Connection as Connection;

class ApplyDAO implements IApplyDAO
{
    private $connection;
    private $tableName = "applies";

    public function add(Apply $apply)
    {
        try {

            $query = "insert into " .
                $this->tableName .
                "(id_user, id_job_offer, cover_letter, resume, ban_status)
                values (:id_user, :id_job_offer, :cover_letter, :resume, :ban_status)";

            $parameters['id_user'] = $apply->getIdUser();
            $parameters['id_job_offer'] = $apply->getIdUser();
            $parameters['cover_letter'] = $apply->getCoverLetter();
            $parameters['resume'] = $apply->getResume();
            $parameters['ban_status'] = $apply->getBanStatus();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $exception) {

            throw $exception;
        }
    }

    public function getAllFromDB()
    {

        try {

            $applyList = array();

            $query = "select * from " . $this->tableName . ";";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {

                $apply = new Apply();
                $apply->setIdApply($row['id_apply']);
                $apply->setIdUser($row['id_user']);
                $apply->setIdJobOffer($row['id_job_offer']);
                $apply->setCoverLetter($row['cover_letter']);
                $apply->setResume($row['resume']);
                $apply->setBanStatus($row['ban_status']);
                array_push($applyList, $apply);
            }
            return $applyList;
        } catch (Exception $exception) {

            throw $exception;
        }
    }

}
?>
