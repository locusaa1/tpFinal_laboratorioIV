<?php
    namespace Controllers;

    use Controllers\StudentController as StudentController;
    use Controllers\AdminController as AdminController;

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
            if (isset($_SESSION['admin'])){
                $controller = new AdminController();
                $controller->AdminView();
            }else{
            require_once (VIEWS_PATH."AdminsLogin.php");
            }
        }

        public function LogOut ()
        {
            session_destroy();
            require_once (VIEWS_PATH."index.php");
        }
    }
?>