<?php


namespace DAO;

use DAO\IEnterpriseDAO as IEnterpriseDAO;
use Models\Enterprise as Enterprise;
use DAO\Connection as Connection;
use Exception as Exception;

class EnterpriseDB_DAO implements IEnterpriseDAO
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

    public function getAll()
    {
        try {

            $enterpriseList = array();

            $query = "select * from " . $this->tableName . ";";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $row) {

                $enterprise = new Enterprise();
                $enterprise->setIdEnterprise($row['id_enterprise']);
                $enterprise->setName($row['name']);
                $enterprise->setCuit($row['cuit']);
                $enterprise->setPhoneNumber($row['phone_number']);
                $enterprise->setAddressName($row['address_name']);
                $enterprise->setAddressNumber($row['address_number']);
                array_push($enterpriseList, $enterprise);
            }

            return $enterpriseList;
        } catch (Exception $exception) {

            throw $exception;
        }
    }

    public function deleteByCuit($cuit)
    {
        $confirm = false;
        try {

            $query = "delete from " . $this->tableName . " where cuit = '" . $cuit . "';";

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query);

            $confirm = true;
        } catch (Exception $exception) {

            throw $exception;
        }
        return $confirm;
    }

    public function updateEnterprise(Enterprise $newEnterprise, $cuit)
    {
        try {

            $query = "update " . $this->tableName . " set " .
                "id_enterprise = '" . $newEnterprise->getIdEnterprise() . "',
                name = '" . $newEnterprise->getName() . "',
                cuit = '" . $newEnterprise->getCuit() . "',
                phone_number = '" . $newEnterprise->getPhoneNumber() . "',
                address_name = '" . $newEnterprise->getAddressName() . "',
                address_number = '" . $newEnterprise->getAddressNumber() . "' 
                where cuit = '" . $cuit . "';";

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query);
        } catch (Exception $exception) {

            throw $exception;
        }
    }

    public function getSpecificEnterpriseByCuit($cuit)
    {
        $enterprise = new Enterprise();

        try {

            $query = "select * from " . $this->tableName . " where cuit ='" . $cuit . "';";

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            if (!empty($resultSet[0])) {

                $enterprise->setIdEnterprise($resultSet[0]['id_enterprise']);
                $enterprise->setName($resultSet[0]['name']);
                $enterprise->setCuit($resultSet[0]['cuit']);
                $enterprise->setPhoneNumber($resultSet[0]['phone_number']);
                $enterprise->setAddressName($resultSet[0]['address_name']);
                $enterprise->setAddressNumber($resultSet[0]['address_number']);
            }
        } catch (Exception $exception) {

            throw $exception;
        }
        return $enterprise;
    }
}