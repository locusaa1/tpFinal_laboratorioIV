<?php


namespace DAO;

use Models\Enterprise as Enterprise;

interface IEnterpriseDAO
{
    function getAll();

    function add(Enterprise $enterprise);

    function deleteByCuit($cuit);

}