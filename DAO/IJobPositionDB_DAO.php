<?php
    namespace DAO;

    use Models\JobPosition as JobPosition;

    interface IJobPositionDB_DAO
    {
        function GetAll();

        function add(JobPosition $jobPosition);
    }
?>