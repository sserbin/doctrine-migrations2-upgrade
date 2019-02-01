<?php declare(strict_types=1);

namespace Sserbin\DoctrineMigrations2Upgrade\Tests;

use Rector\Testing\PHPUnit\AbstractRectorTestCase;
use Sserbin\DoctrineMigrations2Upgrade\MigrationClassRenameRector;

final class MigrationClassRenameRectorTest extends AbstractRectorTestCase
{
    public function test(): void
    {
        $this->doTestFiles([
            __DIR__ . '/Fixture/classRenames.php.inc',
        ]);
    }

    protected function getRectorClass(): string
    {
        return MigrationClassRenameRector::class;
    }
}
