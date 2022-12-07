<?php

namespace App\Services;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;


class DataBaseService
{
    private static ?Connection $connection = null;
    private static DataBaseService $dataBase;
    public static function getConnection(): ?Connection
    {
        if (self::$connection == null) {
            $connectionParams = [
                'dbname' => "{$_ENV["DB_NAME"]}",
                'user' => "{$_ENV["NAME"]}",
                'password' => "{$_ENV["PASSWORD"]}",
                'host' => "{$_ENV["DB_HOST"]}",
                'driver' => 'pdo_mysql',
            ];
            self::$connection = DriverManager::getConnection($connectionParams);
        }

        return self::$connection;


    }

    public function getDataBase(): DataBaseService
    {
        if (self::$dataBase == null) {
            self::$dataBase = new DataBaseService;
        }
        return self::$dataBase;
    }


    public function writeToTable(UserDetails $user): void
    {
        $this->connection->insert('users',
            [
                'name' => $user->getUserName(),
                'email' => $user->getEmail(),
                'password' => password_hash($user->getUserPassword(), PASSWORD_DEFAULT)
            ]
        );
    }

    public function retrieveId($email): ?array
    {
        $queryBuilder = DataBaseService::getConnection()->createQueryBuilder();
        $user = $queryBuilder
            ->select("*")
            ->from("users")
            ->where("email = ?")
            ->setParameter(0, $email)
            ->fetchAssociative();
        return [
            "id" => $user["userid"],
            "name" => $user["name"],
            "email" => $user["email"],
            "password" => $user["password"]
        ];
    }

    public function retrieveById($id){
        $queryBuilder = DataBaseService::getConnection()->createQueryBuilder();
        $user = $queryBuilder
            ->select("*")
            ->from("users")
            ->where("userid = ?")
            ->setParameter(0, $id)
            ->fetchAssociative();
        return [
            "id" => $user["userid"],
            "name" => $user["name"],
            "email" => $user["email"],
            "password" => $user["password"]
        ];
    }
}