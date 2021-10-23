<?php


namespace Utility;


class AdminUtility
{
    public static function checkSessionStatus($sessionStatus)
    {
        if ($sessionStatus == false) {

            $_GET['adminLog'] = true;
            require_once(VIEWS_PATH . 'logInUser.php');
        } elseif ($_SESSION['user']->getUserType() != "admin") {

            $_GET['adminError'] = true;
            require_once(VIEWS_PATH . 'index.php');
        }
    }
}