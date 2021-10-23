<?php

namespace Controllers;

use Controllers\StudentController as StudentController;
use Controllers\AdminController as AdminController;

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
                //default?  
            } 

        }else{
            require_once(VIEWS_PATH . "logInUser.php");
        }
        
    }

    public function NewUser()
    {
        require_once(VIEWS_PATH . "newUser.php");
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