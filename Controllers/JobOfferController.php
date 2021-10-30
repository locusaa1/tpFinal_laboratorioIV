<?php

namespace Controllers;

use DAO\JobOfferDB_DAO as JobOfferDB_DAO;
use Controllers\JobPositionController as JobPositionController;
use Controllers\EnterpriseController as EnterpriseController;
use Controllers\UserController as UserController;
use Controllers\CareerController as CareerController;
use Controllers\StudentController as StudentController;
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
        $enterpriseController = new EnterpriseController();
        $userController = new UserController();

        $jobOfferDTO = new JobOfferDTO();
        $jobOfferDTO->completeSetter($jobOffer->getIdJobOffer(),
            $enterpriseController->getEnterpriseByCuit($jobOffer->getIdEnterprise())->getName(),
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

    public function jobOfferListView($errorMessage = null, $message = null)
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

            if ($jobOffer->getIdUser() == null && $jobOffer->getLimitDate() <= date('Y-m-d')) {

                array_push($outOfDateList, $jobOfferDTO);
            } elseif ($jobOffer->getIdUser()) {

                array_push($appliedList, $jobOfferDTO);
            } else {

                array_push($availableList, $jobOfferDTO);
            }
        }
        require_once(VIEWS_PATH . 'AdminJobOfferList.php');
    }

    public function deleteJobOffer($idJobOffer)
    {
        $this->jobOfferDAO->deleteJobOffer($idJobOffer);
        $this->jobOfferListView();
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

    public function jobOfferFormAction($idEnterprise, $idJobPosition, $startDate, $limitDate, $description, $salary, $idJobOffer, $action)
    {
        $message = null;
        $errorMessage = null;

        if ($limitDate >= date('Y-m-d')) {
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
                $this->jobOfferDAO->updateJobOffer($newJobOffer);
                $message = 'La oferta laboral fue actualizada con éxito';
            } else {

                $newJobOffer->setIdJobPosition($idJobPosition);
                $newJobOffer->setIdEnterprise($idEnterprise);
                $newJobOffer->setStartDate($startDate);
                $newJobOffer->setLimitDate($limitDate);
                $newJobOffer->setDescription($description);
                $newJobOffer->setSalary($salary);
                $this->jobOfferDAO->add($newJobOffer);
                $message = 'La oferta laboral fue creada con éxito';
            }
            $this->jobOfferListView(null,$message);
        } else {

            $errorMessage = 'La fecha limite para crear una oferta laboral debe ser como mínimo hoy!';
            $this->jobOfferListView($errorMessage,null);
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

    public function filterJobOffersByWord($word, $jobOfferList)
    {
        $jobPositionController = new JobPositionController();

        $jobPositionList = $jobPositionController->getJobPositionsByWord($word);

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

    public function jobOfferPresentation($jobOfferId)
    {
        $jobOffer = $this->jobOfferById($jobOfferId);

        echo "Empresa: " . ($this->jobOfferEnterpriseByEnterpriseId($jobOffer->getIdEnterprise()))->getName() . "<br>";
        echo "Posición: " . $this->jobOfferJobPositionDescription($jobOffer->getIdJobPosition()) . "<br>";
        echo "Carrera: " . ($this->jobOfferCareer($jobOffer->getIdJobPosition()))->getDescription() . "<br>";
        echo "Descripción: " . $jobOffer->getDescription() . "<br>";
        echo "Salario: " . settype($jobOffer->getSalary(), 'string') . "<br>";
        echo "Fecha de publicación: " . $jobOffer->getStartDate() . "<br>";
        echo "Fecha de cierre: " . $jobOffer->getLimitDate() . "<br>";
    }

    public function jobOfferStudentView()
    {
        $careerController = new CareerController();
        $careerList = $careerController->careerList();
        $enterpriseController = new EnterpriseController();
        $enterpriseList = $enterpriseController->enterpriseListJobOfferFilterStudent();
        require_once(VIEWS_PATH . "studentOffersView.php");
    }

    public function jobOfferEnterpriseByEnterpriseId($enterpriseId)
    {
        $enterpriseController = new EnterpriseController();
        $enterpriseList = $enterpriseController->enterpriseListJobOfferFilterStudent();

        $enterpriseFounded = null;

        foreach ($enterpriseList as $enterprise) {
            if ($enterprise->getIdEnterprise() == $enterpriseId) {
                $enterpriseFounded = $enterprise;
            }
        }

        return $enterpriseFounded;
    }

    public function studentJobOffersFilterList($careerFilter, $enterpriseFilter, $keyWordFilter)
    {

        $jobPositionController = new JobPositionController();

        $jobOfferList = $this->jobOfferList();

        $filterList = array();

        $jobOfferDTOList=array();

        if ($careerFilter != '') {
            $iterator = 0;
            foreach ($jobOfferList as $jobOffer) {
                $career = $jobPositionController->getJobPositionCareerByJobPositionId($jobOffer->getIdJobPosition());
                if (strcmp($career->getDescription(), $careerFilter) != 0) {
                    unset($jobOfferList[$iterator]);
                }
                $iterator++;
            }

        }

        if ($enterpriseFilter != '') {
            $jobOfferList = array_values($jobOfferList);
            $iterator = 0;
            foreach ($jobOfferList as $jobOffer) {
                $enterprise = $this->jobOfferEnterpriseByEnterpriseId($jobOffer->getIdEnterprise());

                if (strcmp($enterprise->getName(), $enterpriseFilter) != 0) {
                    unset($jobOfferList[$iterator]);
                }
                $iterator++;
            }

        }

        if ($keyWordFilter != '') {
            $filterList = $this->filterJobOffersByWord($keyWordFilter, $jobOfferList);

        }

        if (empty($filterList)) {
            $filterList = $jobOfferList;
        }

        if (empty($filterList)) {
            $_GET['noMatchesFounded'] = 1;
        }else{
            
            foreach($filterList as $jobOffer)
            {
                $dto = $this->generateJobOfferDTO($jobOffer);
                array_push($jobOfferDTOList, $dto);
            }

            if($careerFilter == '' && $enterpriseFilter == '' && $keyWordFilter == '')
            {
                $_GET['searchResults'] = "Resultados";
            }else{
                $_GET['searchResults'] = "Resultados para " . $careerFilter . " " . $enterpriseFilter . " " . $keyWordFilter;
            }
        }

        $careerController = new CareerController();
        $careerList = $careerController->careerList();
        $enterpriseController = new EnterpriseController();
        $enterpriseList = $enterpriseController->enterpriseListJobOfferFilterStudent();

        require_once(VIEWS_PATH . "studentOffersView.php");
    }

    public function JobOfferApplyForm ($id)
    {
        $jobOffer = $this->jobOfferById($id);
        $jobOfferDTO = $this->generateJobOfferDTO($jobOffer);
        require_once(VIEWS_PATH . "studentApplyView.php");
    }

    public function JobOfferAppling ($email, $jobOfferId, $userId, $coverLetter, $resume)
    {
        $studentController = new StudentController();
        $studentCareerId = $studentController->StudentCareerId($email);
        
        $jobOffer = $this->jobOfferById($jobOfferId);
        $jobOfferCareer = $this->jobOfferCareer($jobOffer->getIdJobPosition());

        if($jobOfferCareer->getIdCareer()==$studentCareerId){
            $this->jobOfferDAO->updateJobOfferByAnApply($jobOfferId, $userId, $coverLetter, $resume);
        }else{
            $_GET['noCareerCoincidence'] = 1;
        }

        require_once(VIEWS_PATH . "studentApplyView.php");

    }
}

?>