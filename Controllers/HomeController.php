<?php
    namespace Controllers;

    use Controllers\StudentController as StudentController;

    class HomeController
    {
        public function Index($message = "")
        {
            require_once(VIEWS_PATH."index.php");
        } 
        
        public function Login ()
        {
            if(isset($_SESSION['student'])){
                $controller = new StudentController();
                $controller->StudentView();
            }else{
            require_once (VIEWS_PATH."login.php");
            }
        }

        public function AdminsLogin ()
        {
            require_once (VIEWS_PATH."AdminsLogin.php");
        }

        public function LogOut ()
        {
            session_destroy();
            require_once (VIEWS_PATH."index.php");
        }
    }
?>