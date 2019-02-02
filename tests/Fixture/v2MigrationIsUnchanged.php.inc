<?php

use Doctrine\Migrations\Exception\AbortMigration;
use Doctrine\Migrations\Exception\IrreversibleMigration;
use Doctrine\Migrations\SkipMigrationException;
class Version20190101150002 /*extends AbstractMigration*/
{
    public function up(Schema $schema): void
    {
        if (rand(0, 1)) {
            throw new AbortMigration;
        } else {
            throw new SkipMigrationException;
        }
    }

    public function down(Schema $schema): void
    {
        throw new IrreversibleMigration;
    }
}
-----
<?php

use Doctrine\Migrations\Exception\AbortMigration;
use Doctrine\Migrations\Exception\IrreversibleMigration;
use Doctrine\Migrations\SkipMigrationException;
class Version20190101150002 /*extends AbstractMigration*/
{
    public function up(Schema $schema): void
    {
        if (rand(0, 1)) {
            throw new AbortMigration;
        } else {
            throw new SkipMigrationException;
        }
    }

    public function down(Schema $schema): void
    {
        throw new IrreversibleMigration;
    }
}
