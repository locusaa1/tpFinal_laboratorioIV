<?php


namespace DAO;

use Models\Enterprise as Enterprise;

interface IEnterpriseDAO
{
    function getAll();

    function addEnterprise(Enterprise $enterprise);

    function deleteByCuit($cuit);

}