<?php

declare(strict_types=1);

namespace App\Core\Invoice\Domain\ValueObject\Status;

class InvoiceStatus
{
    public function __construct(
        public readonly string $status
    ) {
    }
}
