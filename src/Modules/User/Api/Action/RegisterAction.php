<?php

namespace App\Modules\User\Api\Action;

use App\Modules\User\Api\Dto\UserDto;
use App\Modules\User\Message\CreatePendingUser;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;

final class RegisterAction
{
    public function __construct(
        private readonly MessageBusInterface $bus,
    )
    {
    }

    #[Route(
        path: '/register',
        name: 'api_user_register',
        methods: ['POST']
    )]
    public function __invoke(
        #[MapRequestPayload] UserDto $userDto,
        Request $request
    ): Response
    {
        $this->bus->dispatch(new CreatePendingUser(
            $userDto->getUsername(),
            $userDto->getEmail(),
            $userDto->getPassword(),
            Uuid::uuid4(),
            (new \DateTime())->modify('+2 hours')
        ));

        return new JsonResponse([], Response::HTTP_OK);
    }
}