<?php

declare(strict_types=1);

namespace App\Core\Invoice\UserInterface\Cli;

use App\Common\Bus\QueryBusInterface;
use App\Core\Invoice\Application\DTO\InvoiceDTO;
use App\Core\Invoice\Application\Query\GetInvoicesByStatusAndAmountGreater\GetInvoicesByStatusAndAmountGreaterQuery;
use App\Core\Invoice\Domain\ValueObject\Status\InvoiceAmount;
use App\Core\Invoice\Domain\ValueObject\Status\InvoiceStatus;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:invoice:get-by-status-and-amount',
    description: 'Pobieranie identyfikatorów faktur dla wybranego statusu i kwot większych od'
)]
class GetInvoices extends Command
{
    public function __construct(private readonly QueryBusInterface $bus)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $invoices = $this->bus->dispatch(new GetInvoicesByStatusAndAmountGreaterQuery(
            new InvoiceStatus($input->getArgument('status')),
            new InvoiceAmount($input->getArgument('amount'))
        ));

        /** @var InvoiceDTO $invoice */
        foreach ($invoices as $invoice) {
            $output->writeln((string) $invoice->id);
        }

        return Command::SUCCESS;
    }

    protected function configure(): void
    {
        $this->addArgument('status', InputArgument::REQUIRED);
        $this->addArgument('amount', InputArgument::REQUIRED);
    }
}
