<?php


namespace DAO;

use Models\Administrator as Admin;

interface IAdminDAO
{
    function add(Admin $admin);

    function getAll();
}