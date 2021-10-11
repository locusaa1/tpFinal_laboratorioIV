<?php

namespace Controllers;

use DAO\StudentDAO as StudentDAO;
use Models\Student as Student;

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
            //header("location:Home/Login.php?emailInvalid=1");
            $_GET['emailInvalid'] = 1;
            require_once(VIEWS_PATH . "login.php");
        }

    }

    public function StudentInfo ()
    {
        require_once(VIEWS_PATH . "studentInformation.php");
    }

    //ver a qué controladora corresponde
    public function EnterpriseList ()
    {
        require_once(VIEWS_PATH . "studentEnterpriseList.php");
    }

    public function StudentView ()
    {
        require_once(VIEWS_PATH . "studentView.php");
    }

}

?>