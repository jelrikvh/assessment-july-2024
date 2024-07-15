<?php

declare(strict_types=1);

namespace App\Edges\Cli;

use App\Application\GenerateCsv;
use App\Application\GenerateCsvHandler;
use PHPUnit\Framework\Attributes\CoversClass;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use App\KernelTestCase;

#[CoversClass(GenerateCsvCliCommand::class)]
#[CoversClass(GenerateCsv::class)]
#[CoversClass(GenerateCsvHandler::class)]
class GenerateCsvCliCommandTest extends KernelTestCase
{
    public function testItSaysHello(): void
    {
        // Arrange
        $kernel = self::createKernel();
        $application = new Application($kernel);

        $command = $application->find('generate-csv');
        $commandTester = new CommandTester($command);

        // Act
        $commandTester->execute([]);

        // Assert
        $commandTester->assertCommandIsSuccessful();

        $output = $commandTester->getDisplay();

        // The output should have 12 * 7 = 84 lines, so it should contain 83 newline characters
        $this->assertSame(83, substr_count($output, "\n"));

        $this->assertStringContainsString('Paul', $output);
        $this->assertStringContainsString('Rens', $output);
    }
}
