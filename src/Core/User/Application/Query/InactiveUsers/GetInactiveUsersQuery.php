<?php

declare(strict_types=1);

namespace App\Core\User\Application\Query\InactiveUsers;

use App\Core\User\Domain\ValueObject\UserStatus;

class GetInactiveUsersQuery
{
    public function __construct(
        public readonly UserStatus $status
    ) {
    }
}