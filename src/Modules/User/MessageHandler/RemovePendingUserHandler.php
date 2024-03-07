<?php

namespace App\Modules\User\MessageHandler;

use App\Modules\User\Message\RemovePendingUser;
use App\Modules\User\Repository\PendingUserRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class RemovePendingUserHandler
{
    public function __construct(
        private readonly PendingUserRepository $pendingUserRepository,
    )
    {
    }

    public function __invoke(RemovePendingUser $message): void
    {
        $this->pendingUserRepository->remove(
            $this->pendingUserRepository->findOneBy(['id' => $message->getId()])
        );
    }
}