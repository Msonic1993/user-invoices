<?php

declare(strict_types=1);

namespace App\Core\Invoice\Domain\ValueObject\Status;

class InvoiceAmount
{
    public function __construct(
        public readonly int $amount
    ) {
    }
}
