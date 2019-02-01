<?php
declare(strict_types=1);
namespace Sserbin\DoctrineMigrations2Upgrade;

use PhpParser\Node;
use PhpParser\Node\Name;
use Rector\Rector\AbstractRector;
use Rector\RectorDefinition\CodeSample;
use Rector\RectorDefinition\RectorDefinition;

/**
 * @see https://github.com/doctrine/migrations/pull/636
 */
class MigrationClassRenameRector extends AbstractRector
{
    private const CLASS_RENAMES = [
        'Doctrine\DBAL\Migrations\AbortMigrationException' => 'Doctrine\Migrations\Exception\AbortMigration',
        'Doctrine\DBAL\Migrations\IrreversibleMigrationException' =>
            'Doctrine\Migrations\Exception\IrreversibleMigration',
        'Doctrine\DBAL\Migrations\SkipMigrationException' => 'Doctrine\Migrations\Exception\SkipMigration',
    ];

    public function getDefinition(): RectorDefinition
    {
        return new RectorDefinition("Renames usages for class names that have been renamed", [
            new CodeSample(
                <<<'CODE_SAMPLE'
use Doctrine\DBAL\Migrations\AbortMigrationException;
use Doctrine\DBAL\Migrations\IrreversibleMigrationException;
use Doctrine\DBAL\Migrations\SkipMigrationException;
class Version20180101150000 extends AbstractMigration
{
}
CODE_SAMPLE
                ,
                <<<'CODE_SAMPLE'
use Doctrine\Migrations\Exception\AbortMigration;
use Doctrine\Migrations\Exception\IrreversibleMigration;
use Doctrine\Migrations\Exception\SkipMigration;
class Version20180101150000 extends AbstractMigration
{
}
CODE_SAMPLE
            )
        ]);
    }

    /**
     * @inheritDoc
     */
    public function getNodeTypes(): array
    {
        return [Name::class];
    }

    public function refactor(Node $node): ?Node
    {
        assert($node instanceof Name);

        foreach (self::CLASS_RENAMES as $old => $new) {
            if ($this->isName($node, $old)) {
                $qualifiedNameParts = explode('\\', $new);
                if ($node->isQualified()) {
                    return new Name($qualifiedNameParts);
                } else {
                    $className = $qualifiedNameParts[count($qualifiedNameParts) - 1];
                    return new Name($className);
                }
            }
        }

        return null;
    }
}
