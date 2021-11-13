<?php

namespace Controllers;

use DAO\StudentDAO as StudentDAO;
use Models\User as User;
use Controllers\JobOfferController as JobOfferController;
use Controllers\CareerController as CareerController;
use Controllers\UserController as UserController;


class StudentController
{
    private $studentDAO;

    public function __construct()
    {
        $this->studentDAO = new StudentDAO();
    }

    /*this function recieves an email from a post form. It calls the StudentDao getByEmail.
    If finds the student by checkig the email, there are two options: if the student is active, goes
    to the studentView. If the student is not active, shows a rejection message.
    If the email is not on the student api, shows another rejection message. */

    public function CheckEmail($email, $user, $password)
    {

        $student = $this->studentDAO->GetByEmail($email);

        if ($student) {
            if ($student->getActive()) {
                if ($user) {
                    $_SESSION ['user'] = $user;
                    require_once(VIEWS_PATH . "studentView.php");
                } else {

                    $user = new User();
                    $user->setEmail($email);
                    $user->setPassword($password);
                    $user->setName($student->getFirstName());
                    $user->setUserType("student");

                    $userController = new UserController();
                    $userController->AddNewUser($user);

                    require_once(VIEWS_PATH . "logInUser.php");
                }

            } else {
                $_GET['notActiveStudent'] = 1;
                require_once(VIEWS_PATH . "logInUser.php");
            }

        } else {
            $_GET['emailInvalidStudent'] = 1;
            require_once(VIEWS_PATH . "logInUser.php");
        }

    }

    public function StudentInfo()
    {
        $student = $this->studentDAO->GetByEmail($_SESSION['user']->getEmail());
        require_once(VIEWS_PATH . "studentInformation.php");
    }

    public function StudentView()
    {
        require_once(VIEWS_PATH . "studentView.php");
    }

    public function StudentCareerId($email)
    {
        $student = $this->studentDAO->GetByEmail($email);

        $careerId = $student->getCareerId();

        return $careerId;
    }

    public function StudentApplyView($userId)
    {
        $jobOfferController = new JobOfferController();
        $applications = $jobOfferController->GetJobOffersByUserApplications();

        require_once(VIEWS_PATH . "studentApplyView.php");
    }

    public function VerifyStudentApplication($userId)
    {
        $jobOfferController = new JobOfferController();
        $application = $jobOfferController->GetJobOfferByUserId($userId);

        return $application;
    }

    public function StudentAcademicInformation()
    {
        $student = $this->studentDAO->GetByEmail($_SESSION['user']->getEmail());

        $careerController = new CareerController();
        $career = $careerController->getCareerById($student->getCareerId());

        require_once(VIEWS_PATH . "studentAcademicInformation.php");

    }

    public function getStudentByEmail($email)
    {
        return $this->studentDAO->GetByEmail($email);
    }
}

?>