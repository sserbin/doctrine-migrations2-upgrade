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

        if (in_array($this->getName($node), ['up', 'down'])) {
            $node->returnType = new Identifier('void');
        }

        return null;
    }
}
