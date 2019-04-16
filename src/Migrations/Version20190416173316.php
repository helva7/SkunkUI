<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190416173316 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE geofence CHANGE lat lat NUMERIC(12, 10) DEFAULT NULL, CHANGE lng lng NUMERIC(12, 10) DEFAULT NULL');
        $this->addSql('ALTER TABLE location CHANGE latitude latitude NUMERIC(12, 10) DEFAULT NULL, CHANGE longitude longitude NUMERIC(12, 10) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE geofence CHANGE lat lat NUMERIC(10, 8) DEFAULT NULL, CHANGE lng lng NUMERIC(10, 8) DEFAULT NULL');
        $this->addSql('ALTER TABLE location CHANGE latitude latitude NUMERIC(11, 8) DEFAULT NULL, CHANGE longitude longitude NUMERIC(12, 8) DEFAULT NULL');
    }
}
