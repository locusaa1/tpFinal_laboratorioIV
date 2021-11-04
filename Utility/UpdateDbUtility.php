<?php


namespace Utility;
use Controllers\CareerController as CareerController;
use Controllers\JobPositionController as JobPositionController;


class UpdateDbUtility
{
    public static function DailyUpdate($update)
    {
        
        if ($update==false) 
        {
            $careerController = new CareerController();
            $careerController->updateCareerDB();

            $jobPositionController = new JobPositionController();
            $jobPositionController->updateJobPositionDB();

            $_GET['alreadyUpdated'] = true;
            
            require_once(VIEWS_PATH . "index.php");
        }else{
            $_GET['alreadyUpdated'] = false;
            require_once(VIEWS_PATH . "index.php");
        } 

        
    }
}

?>