<?php
namespace App\ViewVariables;

use App\Services\DataBaseService;

class AuthViewVariables
{
    public function __construct()
    {

    }

    public function getName(): string
    {
        return "auth";
    }

    public function getValue(): array
    {
        if (! isset($_SESSION["auth_id"]))
        {
            return [];
        }
        $queryBuilder = DataBaseService::getConnection()->createQueryBuilder();
        $user = $queryBuilder
            ->select("*")
            ->from("users")
            ->where("userid = ?")
            ->setParameter(0, $_SESSION['auth_id'])
            ->fetchAssociative();
        return [
            "id" => $user["userid"],
            "name" => $user["name"],
            "email" => $user["email"]
        ];
    }
}