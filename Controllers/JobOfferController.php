<?php

namespace Controllers;

use DAO\JobOfferDB_DAO as JobOfferDB_DAO;
use Controllers\JobPositionController as JobPositionController;
use Controllers\UserController as UserController;
use Models\JobOffer as JobOffer;
use DTO\JobOfferDTO as JobOfferDTO;

class JobOfferController
{
    private $jobOfferDAO;

    public function __construct()
    {
        $this->jobOfferDAO = new JobOfferDB_DAO();
    }

    public function jobOfferList()
    {
        return $this->jobOfferDAO->getAll();
    }

    //todos los datos de job offer + el id position
    //dentro del metodo hago un new de job position
    //dentro $x = new jobPosition;
    // $x->setId($idJobPosition);
    // $jobOffer->setJobPosition($x);
    public function newJobOffer($jobOffer)
    {
        $this->jobOfferDAO->add($jobOffer);
    }

    public function jobOfferListView()
    {
        $activeList = $this->activeJobOfferDTOList();
        $appliedList = $this->appliedJobOfferDTOList();
        $outOfDateList = $this->outOfDateJobOfferDTOList();
        require_once(VIEWS_PATH . 'AdminJobOfferList.php');
    }

    public function outOfDateJobOfferDTOList()
    {
        $jobOfferList = $this->jobOfferList();
        $outOfDateList = array();
        $jobPositionController = new JobPositionController;
        $userController = new UserController();

        foreach ($jobOfferList as $jobOffer) {

            if ($jobOffer->getIdUser() == null && date('d-m-Y', strtotime($jobOffer->getLimitDate())) < date('d-m-Y')) {

                $jobOfferDTO = new JobOfferDTO();
                $jobOfferDTO->completeSetter($jobOffer->getIdJobOffer(),
                    $jobPositionController->getJobPositionCareerByJobPositionId($jobOffer->getIdJobPosition())->getDescription(),
                    $jobPositionController->getJobPositionDescriptionById($jobOffer->getIdJobPosition()),
                    $userController->getUserNameById($jobOffer->getIdUser()),
                    $userController->getUserEmailById($jobOffer->getIdUser()),
                    date('d-m-Y', strtotime($jobOffer->getStartDate())),
                    date('d-m-Y', strtotime($jobOffer->getLimitDate())),
                    $jobOffer->getDescription(),
                    $jobOffer->getSalary(),
                    $jobOffer->getResume(),
                    $jobOffer->getCoverLetter());
                array_push($outOfDateList, $jobOfferDTO);
            }
        }
        return $outOfDateList;
    }

    public function appliedJobOfferDTOList()
    {
        $jobOfferList = $this->jobOfferList();
        $appliedList = array();
        $jobPositionController = new JobPositionController;
        $userController = new UserController();

        foreach ($jobOfferList as $jobOffer) {

            if ($jobOffer->getIdUser()) {

                $jobOfferDTO = new JobOfferDTO();
                $jobOfferDTO->completeSetter($jobOffer->getIdJobOffer(),
                    $jobPositionController->getJobPositionCareerByJobPositionId($jobOffer->getIdJobPosition())->getDescription(),
                    $jobPositionController->getJobPositionDescriptionById($jobOffer->getIdJobPosition()),
                    $userController->getUserNameById($jobOffer->getIdUser()),
                    $userController->getUserEmailById($jobOffer->getIdUser()),
                    date('d-m-Y', strtotime($jobOffer->getStartDate())),
                    date('d-m-Y', strtotime($jobOffer->getLimitDate())),
                    $jobOffer->getDescription(),
                    $jobOffer->getSalary(),
                    $jobOffer->getResume(),
                    $jobOffer->getCoverLetter());
                array_push($appliedList, $jobOfferDTO);
            }
        }
        return $appliedList;
    }

    public function activeJobOfferDTOList()
    {
        $jobOfferList = $this->jobOfferList();
        $activeList = array();
        $jobPositionController = new JobPositionController();
        $userController = new UserController();

        foreach ($jobOfferList as $jobOffer) {

            if ($jobOffer->getIdUser() == null && date('d-m-Y', strtotime($jobOffer->getLimitDate())) >= date('d-m-Y')) {

                $jobOfferDTO = new JobOfferDTO();
                $jobOfferDTO->completeSetter($jobOffer->getIdJobOffer(),
                    $jobPositionController->getJobPositionCareerByJobPositionId($jobOffer->getIdJobPosition())->getDescription(),
                    $jobPositionController->getJobPositionDescriptionById($jobOffer->getIdJobPosition()),
                    $userController->getUserNameById($jobOffer->getIdUser()),
                    $userController->getUserEmailById($jobOffer->getIdUser()),
                    date('d-m-Y', strtotime($jobOffer->getStartDate())),
                    date('d-m-Y', strtotime($jobOffer->getLimitDate())),
                    $jobOffer->getDescription(),
                    $jobOffer->getSalary(),
                    $jobOffer->getResume(),
                    $jobOffer->getCoverLetter());
                array_push($activeList, $jobOfferDTO);
            }
        }
        return $activeList;
    }

    public function filterJobOffersByCareer($careerId)
    {
        $jobPositionController = new JobPositionController();

        $jobPositionByCareerList = $jobPositionController->getJobPositionsByCareer($careerId);

        $jobOfferByCareerList = array();

        foreach ($this->jobOfferList() as $jobOffer) {
            foreach ($jobPositionByCareerList as $jobPosition) {
                if ($jobOffer->getIdJobPosition() == $jobPosition->getJobPositionId()) {
                    array_push($jobOfferByCareerList, $jobOffer);
                }
            }
        }

        return $jobOfferByCareerList;
    }

    public function filterJobOffersByWord($word)
    {
        $jobPositionController = new JobPositionController();

        $jobPositionList = $jobPositionController->getJobPositionsByWord($word);

        $jobOfferList = $this->jobOfferList();

        $filterjobOfferByWordList = array();

        foreach ($jobOfferList as $jobOffer) {
            foreach ($jobPositionList as $jobPosition) {
                if ($jobOffer->getIdJobPosition() == $jobPosition->getJobPositionId()) {
                    array_push($filterjobOfferByWordList, $jobOffer);
                }
            }

        }

        return $filterjobOfferByWordList;
    }

    public function jobOfferJobPositionDescription($idJobPosition)
    {
        $jobPositionController = new JobPositionController();

        return $jobPositionController->getJobPositionDescriptionById($idJobPosition);
    }

    public function jobOfferCareer($idJobPosition)
    {
        $jobPositionController = new JobPositionController();

        return $jobPositionController->getJobPositionCareerByJobPositionId($jobPositionId);
    }

    public function jobOfferById($jobOfferId)
    {
        $jobOfferById = null;

        foreach ($this->jobOfferList() as $jobOffer) {
            if ($jobOffer->getIdJobOffer() == $jobOfferId) {
                $jobOfferById = $jobOffer;
            }

        }

        return $jobOfferById;
    }

    //ver
    public function jobOfferPresentation($jobOfferId)
    {
        $jobOffer = $this->jobOfferById($jobOfferId);

        echo "Empresa: "; //pendiente
        echo "Posición: " . $this->jobOfferJobPositionDescription($jobOffer->getIdJobPosition());
        echo "Carrera: " . $this->jobOfferCareer($jobOffer->getIdJobPosition());
        echo "Descripción: " . $jobOffer->getDescription();
        echo "Salario: " . $jobOffer->getSalary();
        echo "Fecha de publicación: " . $jobOffer->getStartDate();
        echo "Fecha de cierre: " . $jobOffer->getLimitDate();

    }


}

?>