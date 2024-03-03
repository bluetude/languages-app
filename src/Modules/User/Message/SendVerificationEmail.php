<?php

namespace App\Modules\User\Message;

class SendVerificationEmail
{
    private string $email;

    private string $verificationToken;

    /**
     * @param string $email
     * @param string $verificationToken
     */
    public function __construct(string $email, string $verificationToken)
    {
        $this->email = $email;
        $this->verificationToken = $verificationToken;
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
    public function getVerificationToken(): string
    {
        return $this->verificationToken;
    }
}