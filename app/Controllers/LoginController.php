<?php

namespace App\Controllers;
use App\Services\DataBaseService;
use App\Services\userDetails;
use App\Template;
use PDO;
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
        $email = $_POST["email"];
        $password = $_POST["password"];
        $dataBaseService = new DataBaseService();
        $row = $dataBaseService->retrieveId($email);
        var_dump($row);
        if($row->password==md5($password)){
            $_SESSION['id']=session_id();
            $_SESSION['userid']=$row->userid;
            $_SESSION['userid']=$row->name;

            $msg=" welcome $_SESSION[name] login successful";
            echo $msg;
        } else{
            $msg = " Login failed, try again ... ";
        }
        echo $msg;
    }


}