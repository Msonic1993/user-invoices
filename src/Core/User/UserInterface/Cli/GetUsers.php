<?php

declare(strict_types=1);

namespace App\Core\User\UserInterface\Cli;

use App\Core\User\Application\DTO\UserDTO;
use App\Core\User\Application\Query\GetUser\GetUserQuery;
use App\Core\User\Domain\ValueObject\UserStatus;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Common\Bus\QueryBusInterface;


#[AsCommand(
    name: 'app:get:users',
    description: 'Pobieranie uzytkowników'
)]
class GetUsers extends Command
{
    public function __construct(private readonly QueryBusInterface $bus)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $users = $this->bus->dispatch(
            new GetUserQuery(
                new UserStatus((bool) $input->getArgument('active'))
            )
        );

        /** @var UserDTO $user */
        foreach ($users as $user) {
            $output->writeln($user->email);
        }

        return Command::SUCCESS;
    }

    protected function configure(): void
    {
        $this->addArgument('active', InputArgument::REQUIRED);
    }
}