<?php

class DatabaseConnection
{
    private static $instance;

    public static function getDatabaseConnection()
    {
        if (!isset(self::$instance)) {
            $dbname = 'estudos';
            $host = 'localhost';
            $user = 'root';
            $password = '';

            try {
                self::$instance = new PDO('mysql:host=' .$host. ';dbname=' .$dbname, $user, $password);
            } catch (Exception $ex) {
                echo 'Erro: ' . $ex->getMessage();
            }
        }

        return self::$instance;
    }
}