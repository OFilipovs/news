<?php

namespace App\Controllers;
use App\Services\DataBaseService;
use App\Services\LoginService;
use App\Services\userDetails;
use App\Template;
use PDOException;

class LoginController
{
    public function index(): Template
    {
        return new Template
        (
            "register.view",
            [

            ]
        );
    }

    public function registerConfirmation(): Template
    {
        return new Template
        (
            "registerConfirmation.twig",
            [

            ]
        );

    }

    public function register(): void
    {
        session_start();
        $nonEmpty = true;
        $required = ["name", "email", "Password"];
        foreach ($required as $field){
            if (empty($_POST[$field])){
                $nonEmpty = false;
            }
        }

        if ($nonEmpty)
            $dataBaseService = new DataBaseService();
            try {
                $dataBaseService->writeToTable(
                    new UserDetails
                    (
                        $_POST["name"],
                        $_POST["email"],
                        $_POST["Password"]
                    )
                );
                header('Location: /registerConfirmation');
            } catch (PDOException $ex){
                echo "Account with this email exists " . $ex->getMessage();
//                sleep(3);
//                header('Location: /register');
            }
    }

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
        ) ;

        $dataBaseService = new DataBaseService();
        $row = $dataBaseService->retrieveId($credentials->getEmail());
        if ($row > 0 && $credentials->authorise($row)){
            $_SESSION['login_user'] = $row["name"];
            return new Template
            (
                "welcome.twig",
                [
                    "name" => $_SESSION['login_user']
                ]
            );
        } else {
            echo "Wrong pw";
            header("Location: /login");
        }
    }

    public function logout()
    {
        session_destroy();
        header("Location: /login");
    }


}