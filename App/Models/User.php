<?php

namespace App\Models;

use PDORow;
use PDO;

class User extends Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function where(string $where_column, string $operator, string $value): PDORow
    {
        $sql = "SELECT * FROM `users` WHERE `$where_column` $operator '$value' LIMIT 1;";
        $query = $this->conn->query($sql);

        return $query->fetch(PDO::FETCH_LAZY);
    }

    public function auth($login, string $password)
    {
        $sql = "SELECT * FROM `users` WHERE `username` = '$login' AND `password`= '$password' LIMIT 1;";

        $query = $this->conn->query($sql);

        return $query->fetch(PDO::FETCH_ASSOC);
    }

}