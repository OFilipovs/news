<?php

namespace App\Controllers;

use App\Services\DataBaseService;
use App\Services\FormValidationService;
use App\Services\UserDetails;
use App\Services\validFormInputService;
use App\Template;


class RegistrationController
{
    public function index(): Template
    {
        return new Template
        (
            "registrationForm",
            [

            ]
        );
    }

    public function registrationConfirm(): Template
    {
        return new Template
        (
            "registerConfirmation.twig",
            [

            ]
        );
    }


    public function register()
    {
        $userCredentials = $_POST;
        $validationErrors = (new FormValidationService())->validateForm($userCredentials);
        if ($validationErrors === null)
        {
            (new DataBaseService())->writeToTable(new UserDetails($_POST));
            header("Location: /registerConfirmation");
        } else {
            $_SESSION["errors"] = $validationErrors;
            $_SESSION["validInputs"] = (new validFormInputService())->separateValidFromInvalid($validationErrors, $_POST);
            header("Location: /signup");
        }
    }

}