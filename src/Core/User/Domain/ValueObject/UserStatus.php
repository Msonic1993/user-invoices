<?php

declare(strict_types=1);

namespace App\Core\User\Domain\ValueObject;

class UserStatus
{
    public function __construct(
       public readonly bool $status
    ) {
    }
}