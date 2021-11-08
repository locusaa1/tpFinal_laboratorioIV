<?php

namespace Controllers;

use Controllers\StudentController as StudentController;
use Controllers\AdminController as AdminController;
use Controllers\EnterpriseController as EnterpriseController;

class HomeController
{
    public function Index($message = "")
    {
        require_once(VIEWS_PATH . "index.php");
    }

    public function LoginUser()
    {   
        if (isset($_SESSION['user'])) {
            
            $user = $_SESSION['user'];

            $userType = $user->getUserType();
            
            switch($userType){
                case "admin":
                $controller = new AdminController();
                $controller->AdminView();  
                break;
                case "student":
                $controller = new StudentController();
                $controller->StudentView();  
                break;
                case "company":
                $controller = new EnterpriseController();
                $controller->companyView();  
                break; 
            } 

        }else{
            require_once(VIEWS_PATH . "logInUser.php");
        }
        
    }

    public function UserTypeQuestion ()
    {
        require_once(VIEWS_PATH . "userTypeQuestion.php");
    }

    public function NewUserStudent()
    {
        require_once(VIEWS_PATH . "newUserStudent.php");
    }

    public function NewUserCompany()
    {
        require_once(VIEWS_PATH . "newUserCompany.php");
    }

    public function LogOut()
    {
        session_destroy();
        require_once(VIEWS_PATH . "index.php");
    }

    #Test function
    public function test()
    {
        require_once(VIEWS_PATH . 'test.php');
    }
}

?>