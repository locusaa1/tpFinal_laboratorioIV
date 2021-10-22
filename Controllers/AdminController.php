<?php


namespace Controllers;

use DAO\AdminDAO as AdminDAO;
use DAO\AdminDB_DAO as AdminDB;

class AdminController
{
    private $adminDB;

    public function __construct()
    {
        $this->adminDB = new AdminDB();
    }

    public function AdminView()
    {
        require_once (VIEWS_PATH.'AdminView.php');
    }

    /*
     * This function receives two parameters from a post form.
     * This calls the adminDao getAll and iterates looking for the admin to match the attributes.
     * (if it finds an admin) then it sets a session with the values of the objet and shows the admin main view.
     * (if it doesn't) then it sets a log error by $_GET and shows the admin login.
     */
    public function Login($username, $password)
    {
        $adminList = $this->adminDB->getAll();

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

    public function details()
    {
        require_once(VIEWS_PATH . "adminDetails.php");
    }
}