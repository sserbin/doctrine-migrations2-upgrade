<?php declare(strict_types=1);

namespace Sserbin\DoctrineMigrations2Upgrade\Tests;

use Rector\Testing\PHPUnit\AbstractRectorTestCase;
use Sserbin\DoctrineMigrations2Upgrade\MigrationNamespaceChangeRector;

final class MigrationNamespaceChangeRectorTest extends AbstractRectorTestCase
{
    public function test(): void
    {
        $this->doTestFiles([
            __DIR__ . '/Fixture/namespaceChange.php.inc',
            __DIR__ . '/Fixture/v2MigrationIsUnchanged.php.inc',
        ]);
    }

    protected function getRectorClass(): string
    {
        return MigrationNamespaceChangeRector::class;
    }
}
