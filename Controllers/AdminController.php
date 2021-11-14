<?php


namespace Controllers;

use DAO\AdminDAO as AdminDAO;
use DAO\AdminDB_DAO as AdminDB;
use Models\Administrator;
use Exception as Exception;
use Controllers\UserController;

class AdminController
{
    private $adminDB;

    public function __construct()
    {
        $this->adminDB = new AdminDB();
    }

    public function addNewAdmin(Administrator $admin)
    {
        $message = null;
        try {

            $this->adminDB->add($admin);
            $message = 'El registro se almacenó con éxito en la base de datos';
        } catch (Exception $exception) {

            $message = 'Algo inseperado sucedió y el registro no fue almacenado';
        } finally {

            return $message;
        }
    }

    public function AdminView()
    {
        require_once(VIEWS_PATH . 'AdminView.php');
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

    public function details($userEmail)
    {
        $admin = new Administrator();
        $admin = $this->adminDB->getAdminByEmail($userEmail);
        require_once(VIEWS_PATH . "adminDetails.php");
    }

    public function newAdminForm()
    {
        require_once(VIEWS_PATH . "newAdminForm.php");
    }

    
}