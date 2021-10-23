<?php
    namespace DAO;

    use Models\Career as Career;

    interface ICareerDB_DAO
    {
        function GetAll();

        function add(Career $career);
    }
?>