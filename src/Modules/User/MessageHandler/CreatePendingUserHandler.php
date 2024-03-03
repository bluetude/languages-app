<?php

namespace App\Modules\User\MessageHandler;

use App\Modules\User\Entity\PendingUser;
use App\Modules\User\Message\CreatePendingUser;
use App\Modules\User\Repository\PendingUserRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class CreatePendingUserHandler
{
    public function __construct(
        private readonly PendingUserRepository $pendingUserRepository,
    )
    {
    }

    public function __invoke(CreatePendingUser $message): void
    {
        $pendingUser = (new PendingUser())
            ->setUsername($message->getUsername())
            ->setEmail($message->getEmail())
            ->setPassword($message->getPassword())
            ->setVerificationToken($message->getVerificationToken())
            ->setTokenExpirationDate($message->getTokenExpirationDate())
        ;

        $this->pendingUserRepository->add($pendingUser);
    }
}