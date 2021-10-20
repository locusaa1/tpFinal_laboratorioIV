<?php
    namespace DAO;

    use DAO\IJobPositionDAO as IJobPositionDAO;
    use Models\Career as Career;
use Models\JobPosition;

class JobPositionDAO implements IJobPositionDAO
    {
        private $jobPositionList = array();

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->jobPositionList;
        }

        /*
        public function GetByDescription($description) 
        {
            $this->RetrieveData();  
            $careerFounded = null;
            
            if(!empty($this->careerList)){
                foreach($this->careerList as $career){
                    if($career->getDescription() == $description){
                        $careerFounded = $career;
                    }
                }
            }
    
            return $careerFounded;
        }
        */

        /* this function brings the information of the career´s api through a curl handler. Then
        load the list with the obtained career objects*/
        private function RetrieveData()
        {
            $this->jobPositionList = array();

            $ch = curl_init();

            $url = "https://utn-students-api.herokuapp.com/api/JobPosition";

            $header = array (
                'x-api-key: 4f3bceed-50ba-4461-a910-518598664c08'
            );

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

            $response = curl_exec($ch);

            $arrayToDecode = json_decode ($response, true);

            foreach($arrayToDecode as $valuesArray)
            {
                $jobPosition= new JobPosition();
                $jobPosition->setJobPositionId($valuesArray["jobPositionId"]);
                $jobPosition->setCareerId($valuesArray["careerId"]);
                $jobPosition->setDescription($valuesArray["description"]);
                
                array_push($this->jobPositionList, $jobPosition);
            }

        }
    }
?>