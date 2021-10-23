<?php


namespace DAO;

use DAO\IEnterpriseDAO as IEnterpriseDAO;
use Models\Enterprise as Enterprise;
use DAO\Connection as Connection;

class EnterpriseDB_DAO
{
    private $connection;
    private $tableName = "enterprises";

    public function add(Enterprise $enterprise)
    {
        try {

            $query = "insert into " .
                $this->tableName .
                "(id_enterprise, name, cuit, phone_number, address_name, address_number)
                values (:id_enterprise, :name, :cuit, :phone_number, :address_name, :address_number);";

            $parameters['id_enterprise'] = $enterprise->getIdEnterprise();
            $parameters['name'] = $enterprise->getName();
            $parameters['cuit'] = $enterprise->getCuit();
            $parameters['phone_number'] = $enterprise->getPhoneNumber();
            $parameters['address_name'] = $enterprise->getAddressName();
            $parameters['address_number'] = $enterprise->getAddressNumber();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $exception) {

            throw $exception;
        }
    }
}