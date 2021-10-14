<?php

namespace Controllers;

use DAO\StudentDAO as StudentDAO;


class StudentController
{
    private $studentDAO;

    public function __construct()
    {
        $this->studentDAO = new StudentDAO();
    }

    public function CheckEmail($email)
    {

        $student = $this->studentDAO->GetByEmail($email);

        if ($student) {
            if($student->getActive()){
                $_SESSION ['student'] = $student;
                require_once(VIEWS_PATH . "studentView.php");
            }else{
                $_GET['notActive'] = 1;
                require_once(VIEWS_PATH . "login.php");
            }
            
        } else {
            $_GET['emailInvalid'] = 1;
            require_once(VIEWS_PATH . "login.php");
        }

    }

    public function StudentInfo ()
    {
        require_once(VIEWS_PATH . "studentInformation.php");
    }

    public function StudentView ()
    {
        require_once(VIEWS_PATH . "studentView.php");
    }

}

?>