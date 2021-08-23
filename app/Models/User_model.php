<?php

class User_model extends Model
{
    public function getUsers()
    {
        $users = $this->query('SELECT * FROM tb_user');
        return $users;
    }
}