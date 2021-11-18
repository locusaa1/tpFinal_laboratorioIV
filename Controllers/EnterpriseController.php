<?php


namespace Controllers;

use DAO\EnterpriseDB_DAO as EnterpriseDB;
use Models\Enterprise as Enterprise;
use Exception as Exception;
use Models\User as User;
use Controllers\UserController as UserController;
use Controllers\JobOfferController as JobOfferController;

class EnterpriseController
{
    private $enterpriseDB;

    public function getAllEnterprises()
    {
        return $this->enterpriseDB->getAll();
    }

    /**
     * EnterpriseController constructor.
     */
    public function __construct()
    {
        $this->enterpriseDB = new EnterpriseDB();
    }

    public function addEnterprise()
    {
        require_once(VIEWS_PATH . 'AdminEnterpriseCreate.php');
    }

    public function updateEnterprise($enterpriseCuit)
    {

        $enterprise = $this->enterpriseDB->getSpecificEnterpriseByCuit($enterpriseCuit);
        require_once(VIEWS_PATH . 'AdminEnterpriseUpdate.php');
    }

    public function enterpriseList()
    {
        $list = $this->enterpriseDB->getAll();
        require_once(VIEWS_PATH . "AdminEnterpriseList.php");
    }

    public function deleteEnterprise($cuit)
    {
        $message = null;
        $errorMessage = null;
        try {

            $this->enterpriseDB->deleteByCuit($cuit);
            $message = 'La empresa fue exitosamente borrada';
        } catch (Exception $exception) {

            $errorMessage = 'Hubo un problema, la empresa no fue borrada, posiblemente existan ofertas abiertas de la empresa';
        } finally {

            $list = $this->enterpriseDB->getAll();
            require_once(VIEWS_PATH . 'AdminEnterpriseList.php');
        }
    }

    public function enterpriseForm($name, $enterpriseImage, $email, $cuit, $phoneNumber, $addressName, $addressNumber, $action)
    {
        $newEnterprise = new Enterprise();
        $message = null;
        $errorMessage = null;

        try {

            $fileName = $enterpriseImage["name"];
            $file = null;
            $route = null;
            if (strcmp('', $enterpriseImage['name']) != 0) {

                $file = $enterpriseImage["tmp_name"];
                $type = $enterpriseImage["type"];
                $fileName = uniqid("doc") . $fileName;
                $route = UPLOADS_PATH . basename($fileName);
                if (!file_exists(UPLOADS_PATH)) {
                    mkdir(UPLOADS_PATH, 0777, true);
                }
                move_uploaded_file($file, $route);
            }

            if ($action == 'update') {

                $oldEnterprise = $this->enterpriseDB->getSpecificEnterpriseByCuit($cuit);
                $newEnterprise->setIdEnterprise($oldEnterprise->getIdEnterprise());
                $newEnterprise->setEmail($newEmail = (strcmp('', $email) == 0) ? $oldEnterprise->getEMail() : $email);
                $newEnterprise->setCuit($oldEnterprise->getCuit());
                $newEnterprise->setName($newName = (strcmp('', $name) == 0) ? $oldEnterprise->getName() : $name);
                $newEnterprise->setImagePath($newImagePath = (strcmp('', $enterpriseImage['name']) == 0) ? $oldEnterprise->getImagePath() : $route);
                $newEnterprise->setPhoneNumber($newPhoneNumber = (strcmp('', $phoneNumber) == 0) ? $oldEnterprise->getPhoneNumber() : $phoneNumber);
                $newEnterprise->setAddressName($newAddressName = (strcmp('', $addressName) == 0) ? $oldEnterprise->getAddressName() : $addressName);
                $newEnterprise->setAddressNumber($newAddressNumber = (strcmp('', $addressNumber) == 0) ? $oldEnterprise->getAddressNumber() : $addressNumber);
                $this->enterpriseDB->updateEnterprise($newEnterprise, $oldEnterprise->getCuit());
                $message = 'La empresa fue exitosamente actualizada';
            } else {

                $newEnterprise->setName($name);
                $newEnterprise->setImagePath($route);
                $newEnterprise->setEmail($email);
                $newEnterprise->setCuit($cuit);
                $newEnterprise->setPhoneNumber($phoneNumber);
                $newEnterprise->setAddressName($addressName);
                $newEnterprise->setAddressNumber($addressNumber);
                $this->enterpriseDB->add($newEnterprise);
                $message = 'La empresa fue agregada con éxito';
            }
        } catch (Exception $exception) {

            $errorMessage = 'El cuit o teléfono ya se encuentra cargado';
        } finally {

            $list = $this->enterpriseDB->getAll();
            require_once(VIEWS_PATH . 'AdminEnterpriseList.php');
        }
    }

    public function FilterByName($name)
    {
        $enterpriseList = $this->enterpriseDB->getAll();

        $_GET['getIn'] = 1;

        $filterEnterpriseList = array();

        foreach ($enterpriseList as $enterprise) {

            if (stripos($enterprise->getName(), $name) !== false) {

                array_push($filterEnterpriseList, $enterprise);
            }
        }

        if (empty($filterEnterpriseList)) {
            $list = $enterpriseList;
        }

        require_once(VIEWS_PATH . 'studentEnterpriseList.php');
    }

    public function EnterpriseDetails($name)
    {
        $enterprise = $this->enterpriseDB->GetByName($name);

        require_once(VIEWS_PATH . "enterpriseDetails.php");

    }

    public function getEnterpriseByCuit($id)
    {
        return $this->enterpriseDB->getById($id);
    }

    public function EnterpriseListStudent()
    {
        $list = $this->enterpriseDB->getAll();

        require_once(VIEWS_PATH . "studentEnterpriseList.php");
    }

    public function enterpriseListJobOfferFilterStudent()
    {
        return $this->enterpriseDB->getAll();
    }

    public function getEnterpriseByCuitNumber($cuit)
    {
        return $this->enterpriseDB->getSpecificEnterpriseByCuit($cuit);
    }

    public function checkEnterpriseForRegistration($email, $password, $cuit)
    {
        $enterprise = $this->getEnterpriseByCuitNumber($cuit);

        if ($enterprise->getIdEnterprise() != null) {

            $user = new User();
            $user->setEmail($email);
            $user->setPassword($password);
            $user->setName($enterprise->getName());
            $user->setUserType("company");

            $userController = new UserController();
            $userController->AddNewUser($user);

            require_once(VIEWS_PATH . "logInUser.php");
        } else {
            $_GET['notActiveEnterprise'] = 1;
            require_once(VIEWS_PATH . "logInUser.php");
        }
    }

    public function companyView()
    {
        $enterprise = $this->enterpriseDB->GetByName($_SESSION['user']->getName());

        $jobOfferController = new JobOfferController();
        $companyJobOfferList = $jobOfferController->getJobOffersByCompanyName();

        $expiredOffers = 0;

        foreach ($companyJobOfferList as $jobOffer){
            if($jobOffer->getLimitDate() < date('Y-m-d')){
                $expiredOffers++;
            }
        }

        require_once(VIEWS_PATH . "companyView.php");
    }

    public function EnterpriseDetailsCompany($name)
    {
        $enterprise = $this->enterpriseDB->GetByName($name);

        require_once(VIEWS_PATH . "enterpriseDetailsCompany.php");

    }

    public function getEnterpriseByName($name)
    {
        $enterprise = $this->enterpriseDB->GetByName($name);

        return $enterprise;
    }
}