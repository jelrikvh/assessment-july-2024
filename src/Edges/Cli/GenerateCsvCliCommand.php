<?php

declare(strict_types=1);

namespace App\Edges\Cli;

use App\Application\GenerateCsv;
use App\Application\GenerateCsvHandler;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'generate-csv')]
final class GenerateCsvCliCommand extends Command
{
    public function __construct(private readonly GenerateCsvHandler $commandHandler)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $csv = $this->commandHandler->handle(new GenerateCsv());

        $output->write($csv);

        return Command::SUCCESS;
    }
}
