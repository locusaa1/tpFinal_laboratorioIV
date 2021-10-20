<?php
    namespace DAO;

    use DAO\ICareerDAO as ICareerDAO;
    use Models\Career as Career;

    class CareerDAO implements ICareerDAO
    {
        private $careerList = array();

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->careerList;
        }

        /*this function looks for the careers in the list, if it finds it returns it*/
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

        /* this function brings the information of the career´s api through a curl handler. Then
        load the list with the obtained career objects*/
        private function RetrieveData()
        {
            $this->careerList = array();

            $ch = curl_init();

            $url = "https://utn-students-api.herokuapp.com/api/Career";

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
                $career= new Career();
                $career->setIdCareer($valuesArray["careerId"]);
                $career->setDescription($valuesArray["description"]);
                $career->setActive($valuesArray["active"]);
                
                array_push($this->careerList, $career);
            }

        }
    }
?>