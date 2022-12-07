<?php

namespace App\Controllers;

use App\Services\DataBaseService;
use App\Services\LoginService;
use App\Template;

class AccountController
{
    public function changeForm(): Template
    {
        return new Template
        (
            "manageAccount.twig",
            [

            ]
        );
    }

    public function changeConfirm(): Template
    {
        return new Template
        (
            "registerConfirmation.twig",
            [

            ]
        );
    }

    public function change()
    {
        $credentials = new LoginService
        (
            $_POST
        );

        $dataBaseService = new DataBaseService();

        $row = $dataBaseService->retrieveById($_SESSION["auth_id"]);
        if ($row > 0 && $credentials->authorise($row)){
            $connection = DataBaseService::getConnection();
            if (! empty($_POST["newPassword"])){
                $new = password_hash($_POST["newPassword"], PASSWORD_DEFAULT);
                $connection->executeQuery("UPDATE users SET {'password'} = '{$new}' WHERE id = '{$_SESSION['auth_id']}'");
            }

            if (! empty($_POST["newEmail"])){
                $connection->executeQuery("UPDATE users SET {'email'} = '{$_POST['newEmail']}' WHERE id = {$_SESSION['auth_id']}");
            }

            header("Location: /changeConfirm");
        }
    }
}