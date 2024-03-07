<?php

namespace App\Modules\User\MessageHandler;

use App\Modules\User\Message\SendVerificationEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

#[AsMessageHandler]
class SendVerificationEmailHandler
{
    public function __construct(
        private readonly MailerInterface $mailer,
        private readonly UrlGeneratorInterface $urlGenerator,
    )
    {
    }

    public function __invoke(SendVerificationEmail $message): void
    {
        $email = (new Email())
            ->from('marcin.barcz@icloud.com')
            ->to($message->getEmail())
            ->subject('Verify your email')
            ->html('<a href="http://localhost:8000' . $this->urlGenerator->generate('api_verify_email', [
                'token' => $message->getVerificationToken(),
            ]) . '">Verify</a>')
        ;

        try {
            $this->mailer->send($email);
        } catch (TransportExceptionInterface $e) {
        }
    }
}