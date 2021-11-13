<?php
    namespace DAO;

    use Models\Apply as Apply;

    interface IApplyDAO
    {
        function getAllFromDB();

        function add(Apply $apply);
    }
?>