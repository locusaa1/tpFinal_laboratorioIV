<?php


namespace Controllers;

use DAO\AdminDAO as AdminDAO;

class AdminController
{
    private $adminDAO;

    public function __construct()
    {
        $this->adminDAO = new AdminDAO();
    }

    public function AdminView()
    {
        require_once (VIEWS_PATH.'AdminView.php');
    }

    public function Login($username, $password)
    {
        $adminList = $this->adminDAO->getAll();
        foreach ($adminList as $admin) {

            if ($admin->getUsername() == $username && $admin->getPassword() == $password) {

                $_SESSION['admin'] = $admin;
            }
        }
        if (isset($_SESSION['admin'])) {

            require_once(VIEWS_PATH . "AdminView.php");
        } else {

            $_GET['log'] = 'error';
            require_once(VIEWS_PATH . "AdminsLogin.php");
        }
    }

    public function enterpriseList()
    {
        require_once(VIEWS_PATH . "AdminEnterpriseList.php");
    }

    public function details()
    {
        require_once(VIEWS_PATH . "adminDetails.php");
    }
}