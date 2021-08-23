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
        $cmd = $this->databaseConnection->prepare($sql);
        if (count($params) > 0) {
            foreach ($params as $key => $value) {
                $cmd->bindValue($key, $value);
            }
        }
        $cmd->execute();        
        while ($row = $cmd->fetch(PDO::FETCH_ASSOC)) {            
            array_push($result, $row);
        }        
        return $result;
    }
}