<?php
declare(strict_types=1);
namespace Sserbin\DoctrineMigrations2Upgrade;

use PhpParser\Node;
use PhpParser\Node\Name;
use Rector\Rector\AbstractRector;
use Rector\RectorDefinition\CodeSample;
use Rector\RectorDefinition\RectorDefinition;

class MigrationNamespaceChangeRector extends AbstractRector
{
    private const NAMESPACE_1X = 'Doctrine\DBAL\Migrations';
    private const NAMESPACE_2X = 'Doctrine\Migrations';

    public function getDefinition(): RectorDefinition
    {
        return new RectorDefinition("Changes namespace Doctrine\DBAL\Migrations to Doctrine\Migrations", [
            new CodeSample(
                <<<'CODE_SAMPLE'
use Doctrine\DBAL\Migrations\AbstractMigration;
class Version20180101150000 extends AbstractMigration
{
}
CODE_SAMPLE
                ,
                <<<'CODE_SAMPLE'
use Doctrine\Migrations\AbstractMigration;
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

        if (!$node->isQualified()) { // short circuit unqualified names
            return null;
        }

        if ($this->isOldNs($node)) {
            $node->parts = $this->makeNewNs($node);
            return $node;
        }

        return null;
    }

    private function isOldNs(Name $node): bool
    {
        $nsParts = explode('\\', self::NAMESPACE_1X);

        $matches = array_intersect($node->parts, $nsParts);
        return count($matches) === count($nsParts);
    }

    /**
     * @return string[]
     */
    private function makeNewNs(Name $node): array
    {
        $parts = explode('\\', self::NAMESPACE_2X);

        $remaining = array_diff($node->parts, explode('\\', self::NAMESPACE_1X));

        return array_merge($parts, $remaining);
    }
}
