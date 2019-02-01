<?php
declare(strict_types=1);
namespace Sserbin\DoctrineMigrations2Upgrade;

use PhpParser\Node;
use PhpParser\Node\Identifier;
use PhpParser\Node\Stmt\ClassMethod;
use Rector\Rector\AbstractRector;
use Rector\RectorDefinition\CodeSample;
use Rector\RectorDefinition\RectorDefinition;

class MigrationSignatureRector extends AbstractRector
{
    private const REPLACEMENTS_MAP = [
        'up' => 'void',
        'down' => 'void',
        'preUp' => 'void',
        'postUp' => 'void',
        'preDown' => 'void',
        'postDown' => 'void',
        'getDescription' => 'string',
        'isTransactional' => 'bool',
    ];

    public function getDefinition(): RectorDefinition
    {
        return new RectorDefinition(
            "Fixes up/down signature to conform to v2 of Doctrine\Migrations\AbstractMigration",
            [
            new CodeSample(
                <<<'CODE_SAMPLE'
class Version20180101150000 extends AbstractMigration
{
    public function up(Schema $schema)
    {

    }
    public function down(Schema $schema)
    {

    }
}
CODE_SAMPLE
                ,
                <<<'CODE_SAMPLE'
class Version20180101150000 extends AbstractMigration
{
    public function up(Schema $schema): void
    {

    }
    public function down(Schema $schema): void
    {

    }
}
CODE_SAMPLE
            )
            ]
        );
    }

    /**
     * @inheritDoc
     */
    public function getNodeTypes(): array
    {
        return [ClassMethod::class];
    }

    public function refactor(Node $node): ?Node
    {
        assert($node instanceof ClassMethod);

        foreach (self::REPLACEMENTS_MAP as $method => $type) {
            if (!$this->isName($node, $method)) {
                continue;
            }
            if ($node->returnType === $type) {
                return null; // already set, skip
            }

            $node->returnType = new Identifier($type);
        }

        return null;
    }
}
