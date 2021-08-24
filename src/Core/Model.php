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

    public function get($table)
    {
        $result = array();
        $sql = 'SELECT * FROM ' . $table;
        $result = $this->query($sql);
        return $result;
    }

    public function insert($table, $data)
    {
        $columns = '';
        $values = '';

        end($data);
        $lastColumn = key($data);

        foreach ($data as $column => $val) {            
            
            if ($column !== $lastColumn) {
                $columns .= $column . ', ';
                $values .= ':' . $column . ', ';
            } else {
                $columns .= $column;
                $values .= ':' . $column;
            }
        }
        
        $sql = "INSERT INTO ". $table ." (". $columns .") VALUES (". $values .")";
        $this->query($sql, $data);
    }

    public function update($table, $data, $conditions)
    {
        $sql = "UPDATE " . $table . " SET ";
        end($data);
        $lastColumn = key($data);

        foreach ($data as $column => $val) {            
            
            if ($column !== $lastColumn) {
                $sql .= $column ."= :" . $column . ", ";
            } else {
                $sql .= $column ."= :" . $column;
            }
        }

        if (count($conditions) > 0) {
            $sql .= " WHERE ";

            end($conditions);
            $lastCondition = key($conditions);

            foreach ($conditions as $condition => $val) {
            
                if ($condition != $lastCondition) {
                    $sql .= $condition ."= :" . $condition . " AND ";
                } else {
                    $sql .= $condition ."= :" . $condition;
                }
    
            }
        }

        $params = array_merge($data, $conditions);
        $this->query($sql, $params);
    }

    public function delete($table, $conditions)
    {
        $sql = "DELETE FROM " . $table;

        if (count($conditions) > 0) {

            $sql .= " WHERE ";

            end($conditions);
            $lastCondition = key($conditions);

            foreach ($conditions as $condition => $val) {
            
                if ($condition != $lastCondition) {
                    $sql .= $condition ."= :" . $condition . " AND ";
                } else {
                    $sql .= $condition ."= :" . $condition;
                }
            }
        }
        
        $this->query($sql, $conditions);

    }
}