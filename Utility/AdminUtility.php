<?php


namespace Utility;


class AdminUtility
{
    public static function checkSessionStatus($sessionStatus)
    {
        if (!$sessionStatus) {

            $_GET['log'] = 'null';
            require_once(VIEWS_PATH . 'AdminsLogin.php');
        }
    }
}