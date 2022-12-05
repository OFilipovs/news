<?php

namespace App\Services;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;


class DataBaseService
{
    private Connection $connection;
    public function __construct()
    {
        $connectionParams = [
            'dbname' => "{$_ENV["DB_NAME"]}",
            'user' => "{$_ENV["NAME"]}",
            'password' => "{$_ENV["PASSWORD"]}",
            'host' => "{$_ENV["DB_HOST"]}",
            'driver' => 'pdo_mysql',
        ];
        $this->connection = DriverManager::getConnection($connectionParams);


    }

    public function writeToTable(UserDetails $user)
    {
        $this->connection->insert('users', [
                'name' => $user->getUserName(),
                'email' => $user->getEmail(),
                'password' => $user->getUserPassword()]
        );
    }

    public function retrieveId($email)
    {
        return $this->connection->executeQuery("SELECT * FROM Users WHERE email= '{$email}'")->fetchAssociative();
    }


}