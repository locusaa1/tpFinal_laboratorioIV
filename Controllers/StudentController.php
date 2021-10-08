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

    public function ShowAddView()
    {
        require_once(VIEWS_PATH . "student-add.php");
    }

    public function ShowListView()
    {
        $studentList = $this->studentDAO->GetAll();

        require_once(VIEWS_PATH . "student-list.php");
    }

    public function Add($recordId, $firstName, $lastName)
    {
        $student = new Student();
        $student->setRecordId($recordId);
        $student->setfirstName($firstName);
        $student->setLastName($lastName);

        $this->studentDAO->Add($student);

        $this->ShowAddView();
    }

    public function CheckEmail($email)
    {

        $student = $this->studentDAO->GetByEmail($email);

        if ($student) {
            $_SESSION ['student'] = $student;
            require_once(VIEWS_PATH . "studentView.php");
        } else {
            //header("location:Home/Login.php?emailInvalid=1");
            $_GET['emailInvalid'] = 1;
            require_once(VIEWS_PATH . "login.php");
        }

    }
}

?>