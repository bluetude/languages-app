<?php

namespace App\Modules\User\Message;

use DateTimeInterface;

class CreatePendingUser
{
    private string $username;

    private string $email;

    private string $password;

    private string $verificationToken;

    private DateTimeInterface $tokenExpirationDate;

    /**
     * @param string $username
     * @param string $email
     * @param string $password
     * @param string $verificationToken
     * @param DateTimeInterface $tokenExpirationDate
     */
    public function __construct(string $username, string $email, string $password, string $verificationToken, DateTimeInterface $tokenExpirationDate)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->verificationToken = $verificationToken;
        $this->tokenExpirationDate = $tokenExpirationDate;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getVerificationToken(): string
    {
        return $this->verificationToken;
    }

    /**
     * @return DateTimeInterface
     */
    public function getTokenExpirationDate(): DateTimeInterface
    {
        return $this->tokenExpirationDate;
    }
}