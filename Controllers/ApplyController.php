<?php

namespace Controllers;

use DAO\ApplyDAO as ApplyDAO;
use Models\Apply as Apply;
use Controllers\JobPositionController as JobPositionController;
use Controllers\EnterpriseController as EnterpriseController;
use Controllers\CareerController as CareerController;
use DTO\JobOfferAppliesDTO as JobOfferAppliesDTO;
use Controllers\StudentController as StudentController;

class ApplyController
{
    private $applyDAO;

    public function __construct()
    {
        $this->applyDAO = new ApplyDAO();
    }

    public function GetApplyList()
    {
        return $this->applyDAO->getAllFromDB();
    }

    public function GetApplyListByJobOffer($idJobOffer)
    {
        
    }

    public function generateNewApply (Apply $apply)
    {
        $this->applyDAO->add($apply);
    }

    public function verifyIfStudentAlreadyApplyToOffer($idUser, $idJobOffer)
    {
        $applicationFlag = false;

        foreach ($this->GetApplyList() as $apply)
        {
            if($apply->getIdUser()==$idUser && $apply->getIdJobOffer()==$idJobOffer)
            {
                $applicationFlag = true;
            }
        }

        return $applicationFlag;
    }

    public function getJobOffersIdByStudentApplications ()
    {
        $jobOffersIdList = array();

        foreach ($this->GetApplyList() as $apply)
        {
            if($apply->getIdUser()==$_SESSION['user']->getIdUser())
            {
                array_push($jobOffersIdList, $apply->getIdJobOffer());
            }
        }

        return $jobOffersIdList;
    }

    public function generateJobOfferAppliesDTO($jobOffer)
    {
        $jobPositionController = new JobPositionController();
        $enterpriseController = new EnterpriseController();

        $totalApplications = 0;
        $activeApplications = 0;

        foreach ($this->GetApplyList() as $apply){
            if($jobOffer->getIdJobOffer()==$apply->getIdJobOffer())
            {
                $totalApplications++;

                if($apply->getBanStatus()==0){
                    $activeApplications++;
                }
            }
        }

        $jobOfferAppliesDTO = new JobOfferAppliesDTO();
        $jobOfferAppliesDTO->completeSetter($jobOffer->getIdJobOffer(),
            $enterpriseController->getEnterpriseByCuit($jobOffer->getIdEnterprise())->getName(),
            $jobPositionController->getJobPositionCareerByJobPositionId($jobOffer->getIdJobPosition())->getDescription(),
            $jobPositionController->getJobPositionDescriptionById($jobOffer->getIdJobPosition()),
            date('d-m-Y', strtotime($jobOffer->getStartDate())),
            date('d-m-Y', strtotime($jobOffer->getLimitDate())),
            $jobOffer->getDescription(),
            $jobOffer->getSalary(), $totalApplications, $activeApplications);

        return $jobOfferAppliesDTO;
    }

    public function jobOfferWithAppliesCompanyView()
    {
        $careerController = new CareerController();
        $careerList = $careerController->careerList();
        
        $jobPositionController = new JobPositionController();
        $jobPositionList = $jobPositionController->jobPositionList();

        $jobPositionFilterByCompanyList = array();
        
        $jobOfferController = new JobOfferController();
        $companyJobOfferList = $jobOfferController->getJobOffersByCompanyName();

        foreach ($companyJobOfferList as $jobOffer){
            foreach($jobPositionList as $jobPosition){
                if($jobOffer->getIdJobPosition()==$jobPosition->getJobPositionId()){
                    array_push($jobPositionFilterByCompanyList, $jobPosition);
                }
            }
        }

        require_once(VIEWS_PATH . "companyAppliesView.php");
    }

    public function companyJobOffersWithAppliesFilterList($careerFilter, $positionFilter, $keyWordFilter)
    {

        $enterpriseController = new EnterpriseController();
        $jobPositionController = new JobPositionController();
        $jobOfferController = new JobOfferController();

        $jobOfferList = $jobOfferController->jobOfferList();

        $enterprise = $enterpriseController->getEnterpriseByName ($_SESSION['user']->getName());

        $companyJobOfferList = array();

        foreach ($jobOfferList as $jobOffer){
            if($jobOffer->getIdEnterprise()==$enterprise->getIdEnterprise()){
                array_push($companyJobOfferList, $jobOffer);
            }
        }

        $availableList = array();

        foreach ($companyJobOfferList as $jobOffer) {
            if ($jobOffer->getLimitDate() >= date('Y-m-d')) {
                array_push($availableList, $jobOffer);
            }
        }

        $filterList = array();

        $jobOfferAppliesDTOList = array();

        if ($careerFilter != '') {
            $iterator = 0;
            foreach ($availableList as $jobOffer) {
                $career = $jobPositionController->getJobPositionCareerByJobPositionId($jobOffer->getIdJobPosition());
                if (strcmp($career->getDescription(), $careerFilter) != 0) {
                    unset($availableList[$iterator]);
                }
                $iterator++;
            }

        }

        if ($positionFilter != '') {
            $availableList = array_values($availableList);
            $iterator = 0;
            foreach ($availableList as $jobOffer) {
                $jobPositionDescription =  $jobPositionController->getJobPositionDescriptionById ($jobOffer->getIdJobPosition());

                if (strcmp($jobPositionDescription, $positionFilter) != 0) {
                    unset($availableList[$iterator]);
                }
                $iterator++;
            }

        }

        if ($keyWordFilter != '') {
            $filterList = $jobOfferController->filterJobOffersByWord($keyWordFilter, $availableList);
        }

        if (empty($filterList) && $keyWordFilter == '') {
            $filterList = $availableList;
        }

        if (empty($filterList)) {
            $_GET['noMatchesFounded'] = 1;
        } else {

            foreach ($filterList as $jobOffer) {
                $dto = $this->generateJobOfferAppliesDTO($jobOffer);
                array_push($jobOfferAppliesDTOList, $dto);
            }

            if ($careerFilter == '' && $positionFilter == '' && $keyWordFilter == '') {
                $_GET['searchResults'] = "Resultados";

            } else {
                $_GET['searchResults'] = "Resultados para " . $careerFilter . " " . $positionFilter . " " . $keyWordFilter;
            }
        }

        $careerController = new CareerController();
        $careerList = $careerController->careerList();
        
        $jobPositionController = new JobPositionController();
        $jobPositionList = $jobPositionController->jobPositionList();

        $jobPositionFilterByCompanyList = array();
        
        $jobOfferController = new JobOfferController();
        $companyJobOfferList = $jobOfferController->getJobOffersByCompanyName();

        foreach ($companyJobOfferList as $jobOffer){
            foreach($jobPositionList as $jobPosition){
                if($jobOffer->getIdJobPosition()==$jobPosition->getJobPositionId()){
                    array_push($jobPositionFilterByCompanyList, $jobPosition);
                }
            }
        }

        require_once(VIEWS_PATH . "companyAppliesView.php");

    }

    public function companyJobOfferAppliesDetails ($idJobOffer)
    {
        $studentController = new StudentController();
        $jobOfferController = new JobOfferController();
        $jobOffer = $jobOfferController->jobOfferById($idJobOffer);
        $jobOfferAppliesDTO= $this->generateJobOfferAppliesDTO($jobOffer);
        
        $jobOfferApplies = array();

        foreach ($this->GetApplyList() as $apply){
            if($apply->getIdJobOffer()==$idJobOffer){
                array_push($jobOfferApplies, $apply);
            }
        }

        $studentAppliesDTOList = array();

        foreach ($jobOfferApplies as $apply){
            $studentApplyDTO = $studentController->generateStudentApplicationDTO($apply->getIdApply(), $idJobOffer, $apply->getIdUser(),
            $apply->getCoverLetter(), $apply->getResume(), $apply->getBanStatus());

            array_push($studentAppliesDTOList, $studentApplyDTO);

        }

        $activeAppliesList = array();
        $notActiveAppliesList = array();

        foreach ($studentAppliesDTOList as $applyDTO){
            if($applyDTO->getBanStatus()==0){
                array_push($activeAppliesList, $applyDTO);
            }else{
                array_push($notActiveAppliesList, $applyDTO);
            }
        }

        require_once(VIEWS_PATH . "companyAppliesByJobOffer.php");

    }

    public function dismissApplicationByCompany ($idApply, $idJobOffer)
    {
        $this->applyDAO->updateApplyBanStatusTo1 ($idApply);

        $this->companyJobOfferAppliesDetails($idJobOffer);        

    }

    public function getStudentAppliesByUserId()
    {
        $applyList = array();

        foreach($this->GetApplyList() as $apply){
            if($apply->getIdUser()==$_SESSION['user']->getIdUser()){
                array_push($applyList, $apply);
            }
        }

        return $applyList;
    }

    public function dismissApplicationByStudent ($idJobOffer)
    {
        $applies = $this->getStudentAppliesByUserId ();

        foreach($applies as $apply){
            if($apply->getIdJobOffer()==$idJobOffer){
                $this->applyDAO->updateApplyBanStatusTo1 ($apply->getIdApply());
            }
        } 
        
        $studentController = new StudentController();
        $studentController->StudentApplyView();

    }
}

?>