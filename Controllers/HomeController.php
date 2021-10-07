<?php
    namespace Controllers;

    class HomeController
    {
        public function Index($message = "")
        {
            require_once(VIEWS_PATH."index.php");
        } 
        
        public function Login ()
        {
            require_once (VIEWS_PATH."login.php");
        }

        public function AdminsLogin ()
        {
            require_once (VIEWS_PATH."AdminsLogin.php");
        }
    }
?>