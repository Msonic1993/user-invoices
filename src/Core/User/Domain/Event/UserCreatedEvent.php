<?php

declare(strict_types=1);

namespace App\Event;

namespace App\Core\User\Domain\Event;

use App\Common\EventManager\EventInterface;
use App\Core\User\Domain\User;

class UserCreatedEvent implements EventInterface
{
    public function __construct(
        public readonly User $user
    ) {
    }

}