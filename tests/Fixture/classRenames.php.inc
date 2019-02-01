<?php

use Doctrine\DBAL\Migrations\AbortMigrationException;
use Doctrine\DBAL\Migrations\IrreversibleMigrationException;
use Doctrine\DBAL\Migrations\SkipMigrationException;
class Version20180101150002 /*extends AbstractMigration*/
{
    public function up(Schema $schema)
    {
        if (rand(0, 1)) {
            throw new AbortMigrationException;
        } else {
            throw new SkipMigrationException;
        }
    }

    public function down(Schema $schema)
    {
        throw new IrreversibleMigrationException;
    }
}
-----
<?php

use Doctrine\Migrations\Exception\AbortMigration;
use Doctrine\Migrations\Exception\IrreversibleMigration;
use Doctrine\Migrations\Exception\SkipMigration;
class Version20180101150002 /*extends AbstractMigration*/
{
    public function up(Schema $schema)
    {
        if (rand(0, 1)) {
            throw new AbortMigration;
        } else {
            throw new SkipMigration;
        }
    }

    public function down(Schema $schema)
    {
        throw new IrreversibleMigration;
    }
}
