<?php

declare(strict_types=1);

namespace App\Core\User\UserInterface\Cli;

use App\Core\User\Application\Command\CreateUser\CreateUserCommand;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsCommand(
    name: 'app:get:inactive:users',
    description: 'Pobieranie niekatywnych uzytkowników'
)]
class GetInactiveUsers extends Command
{
    public function __construct(private readonly MessageBusInterface $bus)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->bus->dispatch(
            new CreateUserCommand(
                $input->getArgument('active')
            )
        );

        return Command::SUCCESS;
    }

    protected function configure(): void
    {
        $this->addArgument('active', InputArgument::REQUIRED);
    }
}