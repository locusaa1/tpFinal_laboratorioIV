<?php
    namespace DAO;

    use Models\JobPosition as JobPosition;

    interface IJobPositionDAO
    {
        function getAllFromApi();

        function getAllFromDB();

        function add(JobPosition $jobPosition);
    }
?>