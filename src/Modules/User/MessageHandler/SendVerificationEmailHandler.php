<?php

namespace App\Modules\User\MessageHandler;

use App\Modules\User\Message\SendVerificationEmail;
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
            ->from('test@exmaple.com')
            ->to($message->getEmail())
            ->subject('Verify your email')
            ->html($this->urlGenerator->generate('api_verify_email', [
                'slug' => $message->getVerificationToken(),
            ]))
        ;

        $this->mailer->send($email);
    }
}