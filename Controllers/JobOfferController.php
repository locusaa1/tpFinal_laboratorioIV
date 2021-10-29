<?php

namespace Controllers;

use DAO\JobOfferDB_DAO as JobOfferDB_DAO;
use Controllers\JobPositionController as JobPositionController;
use Controllers\EnterpriseController as EnterpriseController;
use Controllers\UserController as UserController;
use Controllers\CareerController as CareerController;
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

    public function generateJobOfferDTO($jobOffer)
    {
        $jobPositionController = new JobPositionController();
        $userController = new UserController();

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

        return $jobOfferDTO;
    }

    public function jobOfferListView()
    {
        $jobOfferList = $this->jobOfferList();
        $enterpriseController = new EnterpriseController();
        $enterpriseList = $enterpriseController->getAllEnterprises();
        $jobPositionController = new JobPositionController();
        $jobPositionList = $jobPositionController->jobPositionList();
        $outOfDateList = array();
        $availableList = array();
        $appliedList = array();

        foreach ($jobOfferList as $jobOffer) {

            $jobOfferDTO = $this->generateJobOfferDTO($jobOffer);

            if ($jobOffer->getIdUser() == null && date('d-m-Y', strtotime($jobOffer->getLimitDate())) < date('d-m-Y')) {

                array_push($outOfDateList, $jobOfferDTO);
            } elseif ($jobOffer->getIdUser()) {

                array_push($appliedList, $jobOfferDTO);
            } else {

                array_push($availableList, $jobOfferDTO);
            }
        }
        require_once(VIEWS_PATH . 'AdminJobOfferList.php');
    }

    public function jobOfferForm()
    {
        $jobOffer = null;
        $jobOfferDTO = null;
        $enterpriseController = new EnterpriseController();
        $enterpriseList = $enterpriseController->getAllEnterprises();
        $jobPositionController = new JobPositionController();
        $jobPositionList = $jobPositionController->jobPositionList();
        if (isset($_GET['update'])) {

            $jobOffer = $this->jobOfferDAO->getSpecificJobOfferById($_GET['update']);
            $jobOfferDTO = $this->generateJobOfferDTO($jobOffer);
        }

        require_once(VIEWS_PATH . 'AdminJobOfferForm.php');
    }

    public function jobOfferFormAction($idEnterprise, $idJobPosition, $startDate, $limitDate, $description, $salary, $action, $idJobOffer)
    {
        $message = null;
        $errorMessage = null;
        if (date('d-m-Y',strtotime($limitDate)) >= date('d-m-Y')) {
            $newJobOffer = new JobOffer();

            if ($action == 'update') {

                $oldJobOffer = $this->jobOfferDAO->getSpecificJobOfferById($idJobOffer);
                $newJobOffer->setIdJobOffer($idJobOffer);
                $newJobOffer->setIdJobPosition($newId = (strcmp('', $idJobPosition) == 0) ? $oldJobOffer->getIdJobPosition() : $idJobPosition);
                $newJobOffer->setIdEnterprise($newId = (strcmp('', $idEnterprise) == 0) ? $oldJobOffer->getIdEnterprise() : $idEnterprise);
                $newJobOffer->setStartDate($newStartDate = (strcmp('', $startDate) == 0) ? $oldJobOffer->getStartDate() : $startDate);
                $newJobOffer->setLimitDate($newLimitDate = (strcmp('', $limitDate) == 0) ? $oldJobOffer->getLimitDate() : $limitDate);
                $newJobOffer->setDescription($newDescription = (strcmp('', $description) == 0) ? $oldJobOffer->getDescription() : $description);
                $newJobOffer->setSalary($newSalary = (strcmp('', $salary) == 0) ? $oldJobOffer->getSalary() : $salary);
                $this->jobOfferDAO->add($newJobOffer);
                $message = 'La oferta laboral fue actualizada con éxito';
            } else {

                $newJobOffer->setIdJobPosition($idJobPosition);
                $newJobOffer->setIdEnterprise($idEnterprise);
                $newJobOffer->setStartDate($startDate);
                $newJobOffer->setLimitDate($limitDate);
                $newJobOffer->setSalary($salary);
                $this->jobOfferDAO->add($newJobOffer);
                $message = 'La oferta laboral fue creada con éxito';
            }
        }else{

            $errorMessage = 'La fecha limite para crear una oferta laboral debe ser como mínimo hoy!';
        }
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

        return $jobPositionController->getJobPositionCareerByJobPositionId($idJobPosition);
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

    public function jobOfferStudentView()
    {
        $careerController = new CareerController();
        $careerList = $careerController->careerList();
        $enterpriseController = new EnterpriseController();
        $enterpriseList = $enterpriseController->enterpriseListJobOfferFilterStudent();
        require_once(VIEWS_PATH . "studentOffersView.php");
    }

    
}

?>