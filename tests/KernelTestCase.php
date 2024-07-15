<?php

declare(strict_types=1);

namespace App;

/**
 * This whole class is needed because of this problem between Symfony 7 / PHPUnit 11:
 * @see https://github.com/symfony/symfony/issues/53812
 */
abstract class KernelTestCase extends \Symfony\Bundle\FrameworkBundle\Test\KernelTestCase
{
    protected function restoreExceptionHandler(): void
    {
        while (true) {
            $previousHandler = set_exception_handler(static fn() => null);

            restore_exception_handler();

            if ($previousHandler === null) {
                break;
            }

            restore_exception_handler();
        }
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->restoreExceptionHandler();
    }
}
