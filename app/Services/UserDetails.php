<?php

namespace App\Services;

class UserDetails
{
    private string $userName;
    private string $email;
    private string $userPassword;


    public function __construct(string $userName, string $email, string $userPassword)
    {
        $this->userName = $userName;
        $this->email = $email;
        $this->userPassword = password_hash($userPassword, PASSWORD_DEFAULT);
    }

    public function getUserName(): string
    {
        return $this->userName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getUserPassword(): string
    {
        return $this->userPassword;
    }
}