<?php
    namespace Models;

    use Models\Person as Person;

    class Student extends Person
    {

        private $studentId;
        private $careerId;
        private $fileNumber;
        private $active;

        public function __construct()
        {
            
        }

        public function getStudentId()
        {
                return $this->studentId;
        }
 
        public function setStudentId($studentId)
        {
                $this->studentId = $studentId;

                return $this;
        }

        public function getCareerId()
        {
                return $this->careerId;
        }

        public function setCareerId($careerId)
        {
                $this->careerId = $careerId;

                return $this;
        }
        
        public function getFileNumber()
        {
                return $this->fileNumber;
        }
       
        public function setFileNumber($fileNumber)
        {
                $this->fileNumber = $fileNumber;

                return $this;
        }

        
        public function getActive()
        {
                return $this->active;
        }
        
        public function setActive($active)
        {
                $this->active = $active;

                return $this;
        }
    }
?>

