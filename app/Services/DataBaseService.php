<?php

namespace App\Services;

use PDO;

class DataBaseService
{
    private PDO $connection;
    public function __construct()
    {
        $servername = $_ENV["SERVER"];
        $username = $_ENV["NAME"];
        $password = $_ENV["PASSWORD"];
        $this->connection = new PDO("mysql:host=$servername;dbname=sign_up", $username, $password);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function writeToTable(UserDetails $user)
    {
        $sql = "INSERT INTO users (name,email,password) VALUES ('{$user->getUserName()}','{$user->getEmail()}','{$user->getUserPassword()}')";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
    }

    public function retrieveId($email)
    {
        $sql = "SELECT name,password,userid FROM users WHERE ('$email')";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":userid",$userid,PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function retrieveFromTable()
    {

    }
}