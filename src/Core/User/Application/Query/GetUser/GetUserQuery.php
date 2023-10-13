<?php

declare(strict_types=1);

namespace App\Core\User\Application\Query\GetUser;

use App\Core\User\Domain\ValueObject\UserStatus;

class GetUserQuery
{
    public function __construct(
        public readonly UserStatus $status
    ) {
    }
}