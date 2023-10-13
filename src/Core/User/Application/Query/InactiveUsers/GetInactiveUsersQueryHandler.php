<?php

declare(strict_types=1);

namespace App\Core\User\Application\Query\InactiveUsers;

use App\Core\User\Domain\Repository\UserRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class GetInactiveUsersQueryHandler
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository
    ) {
    }

    public function __invoke(GetInactiveUsersQuery $query): array
    {
        return $this->userRepository->getInactiveUsers(
            $query->status
        );
    }
}