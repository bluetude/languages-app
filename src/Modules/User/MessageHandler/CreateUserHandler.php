<?php

namespace App\Modules\User\MessageHandler;

use App\Modules\User\Entity\User;
use App\Modules\User\Message\CreateUser;
use App\Modules\User\Repository\UserRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsMessageHandler]
class CreateUserHandler
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly UserPasswordHasherInterface $passwordHasher,
    )
    {
    }

    public function __invoke(CreateUser $message): void
    {
        $user = new User();
        $user
            ->setUsername($message->getUsername())
            ->setEmail($message->getEmail())
            ->setPassword($this->passwordHasher->hashPassword(
                $user,
                $message->getPassword()
            ))
        ;

        $this->userRepository->add($user);
    }
}