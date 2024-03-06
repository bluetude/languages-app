<?php

namespace App\Modules\User\Api\Action;

use App\Modules\User\Message\CreateUser;
use App\Modules\User\Repository\PendingUserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;

class VerifyEmailAction
{
    public function __construct(
        private readonly PendingUserRepository $pendingUserRepository,
        private readonly MessageBusInterface $bus,
    )
    {
    }

    #[Route(
        path: 'verify-email/{token}',
        name: 'api_verify_email',
        methods: ['POST']
    )]
    public function __invoke(string $token): Response
    {
        $pendingUser = $this->pendingUserRepository
            ->findOneBy(['verificationToken' => $token]);

        if (null === $pendingUser) {
            return new JsonResponse([], Response::HTTP_NOT_FOUND);
        }

        $this->bus->dispatch(new CreateUser(
            $pendingUser->getUsername(),
            $pendingUser->getEmail(),
            $pendingUser->getPassword()
        ));

        return new JsonResponse([], Response::HTTP_OK);
    }
}