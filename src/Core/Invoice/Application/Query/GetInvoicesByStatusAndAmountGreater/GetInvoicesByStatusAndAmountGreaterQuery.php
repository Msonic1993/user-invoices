<?php

declare(strict_types=1);

namespace App\Core\Invoice\Application\Query\GetInvoicesByStatusAndAmountGreater;

use App\Core\Invoice\Domain\ValueObject\Status\InvoiceAmount;
use App\Core\Invoice\Domain\ValueObject\Status\InvoiceStatus;

class GetInvoicesByStatusAndAmountGreaterQuery
{
    public function __construct(
        public readonly InvoiceStatus $status,
        public readonly InvoiceAmount $amount
    ) {
    }
}
