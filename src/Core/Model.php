<?php

require 'DatabaseConnection.php';

class Model
{
    private $databaseConnection;

    public function __construct()
    {
        $this->databaseConnection = DatabaseConnection::getDatabaseConnection();
    }

    public function query($sql, $params = array())
    {
        $result = array();
        $this->databaseConnection->prepare($sql);
        if (count($params) > 0) {
            foreach ($params as $key => $value) {
                $this->databaseConnection->bindValue($key, $value);
            }
        }
        $this->databaseConnection->execute();
        while ($row = $this->databaseConnection->fetch(PDO::FETCH_ASSOC)) {
            array_push($row, $result);
        }
        return $result;
    }
}