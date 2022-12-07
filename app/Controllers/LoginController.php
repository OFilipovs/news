<?php

namespace App\Controllers;
use App\Services\DataBaseService;
use App\Services\LoginService;
use App\Services\userDetails;
use App\Template;
use PDOException;

class LoginController
{
    public function loginForm(): Template
    {
        return new Template
        (
            "login.twig",
            [

            ]
        );
    }

    public function login()
    {
        $credentials = new LoginService
        (
            $_POST["email"],
            $_POST["password"]
        );

        $dataBaseService = new DataBaseService();
        $row = $dataBaseService->retrieveId($credentials->getEmail());

        if ($row > 0 && $credentials->authorise($row)){
            $_SESSION['auth_id'] = $row["id"];
            return new Template
            (
                "welcome.twig",
                [
                    "name" => $row["name"]
                ]
            );
        } else {
            echo "Wrong pw";
            header("Location: /login");
        }
    }

    public function logout()
    {
        unset($_SESSION["auth_id"]);
        header("Location: /");
    }


}