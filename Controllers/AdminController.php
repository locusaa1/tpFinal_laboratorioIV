<?php


namespace Controllers;

use DAO\AdminDAO as AdminDAO;
use DAO\AdminDB_DAO as AdminDB;
use Models\Administrator;
use Controllers\UserController;
use Models\User;
use Exception as Exception;

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

    public function newAdminForm($message = null)
    {
        require_once(VIEWS_PATH . "newAdminForm.php");
    }

    public function newAdminFormAction($firstName, $lastName, $dni, $gender, $birthDate, $phoneNumber, $email)
    {
        $userController = new UserController;
        $admin = new Administrator();
        $admin->setFirstName($firstName);
        $admin->setLastName($lastName);
        $admin->setDni($dni);
        $admin->setGender($gender);
        $admin->setBirthDate($birthDate);
        $admin->setPhoneNumber($phoneNumber);
        $admin->setEmail($email);
        $message = $this->addNewAdmin($admin);
        if (strcmp($message, 'El registro se almacenó con éxito en la base de datos') == 0) {

            $newUser = new User();
            $newUser->setName($admin->getFirstName());
            $newUser->setEmail($admin->getEmail());
            $newUser->setPassword($admin->getDni());
            $newUser->setUserType('admin');
            $message = $userController->AddNewUser($newUser);
            if (strcmp($message, 'El registro se almacenó con éxito en la base de datos') == 0) {

                $subject = 'Registro de administrador';
                $emailMessage = 'Felicidades: ' . $admin->getFirstName() . ', tu usuario dentro del a plataforma
                de la Universidad Tecnológica Nacional ha sido creado con éxito.\r\n Una vez dentro de ella asgurate
                de actualizar la contraseña actual por una más segura.\r\n
                Los datos para ingresar son tu email(' . $admin->getEmail() . ') como usuario y tu dni (' . $admin->getDni() . ') como contraseña';


                try {

                    mail($admin->getEmail(),$subject,$message);
                } catch (Exception $exception){

                    die(var_dump($exception));
                }
                $confirm = mail($admin->getEmail(), $subject, $emailMessage);
            }
        }
        $this->newAdminForm($message);
    }
}