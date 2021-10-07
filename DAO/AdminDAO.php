<?php


namespace DAO;

use DAO\IAdminDAO as IAdminDAO;
use Models\Administrator as Admin;


class AdminDAO implements IAdminDAO
{
    //This first admin DAO uses JSON as the main place to save the data.
    private $adminList = array();
    private $fileName;

    //This function retrieves all the info from the json if it exists
    private function loadData()
    {
        $this->adminList = array();

        if (file_exists($this->fileName)) {

            $content = file_get_contents($this->fileName);
            $decodedArray = ($content) ? json_decode($content, true) : array();
            foreach ($decodedArray as $admin) {

                $newAdmin = new Admin();
                $newAdmin->setFirstName($admin['firstName']);
                $newAdmin->setLasName($admin['lastName']);
                $newAdmin->setDni($admin['dni']);
                $newAdmin->setBirthDate($admin['birthDate']);
                $newAdmin->setGender($admin['gender']);
                $newAdmin->setEmail($admin['email']);
                $newAdmin->setPhoneNumber($admin['phoneNumber']);
                $newAdmin->setIdAdmin($admin['idAdmin']);
                $newAdmin->setUsername($admin['userName']);
                $newAdmin->setPassword($admin['password']);
                array_push($this->adminList, $newAdmin);
            }
        }
    }

    //This function saves all the admins into the json file
    private function saveData()
    {
        $arrayToEncode = array();

        foreach ($this->adminList as $admin) {

            $newAdmin['firstName'] = $admin->getFirstName();
            $newAdmin['lastName'] = $admin->getLastName();
            $newAdmin['dni'] = $admin->getDni();
            $newAdmin['birthDate'] = $admin->getBirthDate();
            $newAdmin['gender'] = $admin->getGender();
            $newAdmin['email'] = $admin->getEmail();
            $newAdmin['phoneNumber'] = $admin->getPhoneNumer();
            $newAdmin['idAdmin'] = $admin->getIdAdmin();
            $newAdmin['username'] = $admin->getUsername();
            $newAdmin['password'] = $admin->getPassword();
            array_push($arrayToEncode, $newAdmin);
        }
        $content = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        file_put_contents($this->fileName, $content);
    }

    public function add(Admin $admin)
    {
        $this->loadData();
        array_push($this->adminList, $admin);
        $this->saveData();
    }

    public function getAll()
    {
        $this->loadData();
        return $this->adminList;
    }

    public function __construct()
    {
        $this->fileName = FRONT_ROOT."Data/students.json";
    }
}