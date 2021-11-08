<?php


namespace Controllers;

use DAO\UserDB_DAO as UserDB_DAO;
use Controllers\StudentController as StudentController;
use Controllers\EnterpriseController as EnterpriseController;
use Models\User as User;

class UserController
{
    private $userDB;

    public function __construct()
    {
        $this->userDB = new UserDB_DAO();
    }

    public function LoginUser($email, $password)
    {
        $user = $this->userDB->getSpecificEmailUser($email);

        if ($user) {
            if ($user->getPassword() == $password) {

                $userType = $user->getUserType();

                switch ($userType) {
                    case "admin":
                        $_SESSION ['user'] = $user;
                        require_once(VIEWS_PATH . "AdminView.php");
                        break;
                    case "student":
                        $controller = new StudentController();
                        $controller->CheckEmail($email, $user, $password);
                        break;
                    case "company":
                        $_SESSION ['user'] = $user;
                        $controller = new EnterpriseController();
                        $controller->companyView();
                        break;
                }
            } else {
                $_GET['wrongPassword'] = 1;
                require_once(VIEWS_PATH . "logInUser.php");
            }
        } else {
            $_GET['userNotFounded'] = 1;
            require_once(VIEWS_PATH . "logInUser.php");
        }
    }

    public function NewUserStudent($email, $password, $repeatedPassword)
    {

        $user = $this->userDB->getSpecificEmailUser($email);

        if ($user) {
            $_GET['userAlreadyRegistered'] = 1;
            require_once(VIEWS_PATH . "logInUser.php");
        }
        
        if ($password == $repeatedPassword) {
            $controller = new StudentController();
            $controller->CheckEmail($email, $user, $password);
        } else {
            $_GET['wrongRepeatedPassword'] = 1;
            require_once(VIEWS_PATH . "newUserStudent.php");
        }
    }

    public function NewUserCompany($email, $password, $repeatedPassword, $cuit)
    {

        $user = $this->userDB->getSpecificEmailUser($email);

        if ($user) {
            $_GET['userAlreadyRegistered'] = 1;
            require_once(VIEWS_PATH . "logInUser.php");
        }
        
        if ($password == $repeatedPassword) {
            $controller = new EnterpriseController();
            $controller->checkEnterpriseForRegistration($email, $password, $cuit);
        } else {
            $_GET['wrongRepeatedPassword'] = 1;
            require_once(VIEWS_PATH . "newUserCompany.php");
        }
    }

    public function getUserNameById($idUser)
    {
        $userList = $this->userDB->getAll();
        $name = null;

        foreach ($userList as $user) {

            if ($user->getIdUser() == $idUser) {
                $name = $user->getName();
            }
        }
        return $name;
    }

    public function getUserEmailById($idUser)
    {
        $userList = $this->userDB->getAll();
        $email = null;

        foreach ($userList as $user) {

            if ($user->getIdUser() == $idUser) {

                $email = $user->getEmail();
            }
        }
        return $email;
    }

    public function AddNewUser (User $user)
    {
        $this->userDB->add($user);
    }
}