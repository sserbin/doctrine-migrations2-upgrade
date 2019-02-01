<?php declare(strict_types=1);

namespace Sserbin\DoctrineMigrations2Upgrade\Tests;

use Rector\Testing\PHPUnit\AbstractRectorTestCase;
use Sserbin\DoctrineMigrations2Upgrade\MigrationSignatureRector;

final class MigrationSignatureRectorTest extends AbstractRectorTestCase
{
    public function test(): void
    {
        $this->doTestFiles([
            __DIR__ . '/Fixture/signatureChange.php.inc',
        ]);
    }

    protected function getRectorClass(): string
    {
        return MigrationSignatureRector::class;
    }
}
