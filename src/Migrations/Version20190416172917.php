<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190416172917 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE geofence (id INT AUTO_INCREMENT NOT NULL, lat NUMERIC(10, 8) DEFAULT NULL, lng NUMERIC(10, 8) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE test');
        $this->addSql('ALTER TABLE location ADD dog_name VARCHAR(255) DEFAULT NULL, ADD speed NUMERIC(3, 3) DEFAULT NULL, CHANGE Latitude latitude NUMERIC(11, 8) DEFAULT NULL, CHANGE Longitude longitude NUMERIC(12, 8) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE test (Column1 VARCHAR(50) DEFAULT NULL COLLATE latin1_swedish_ci) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE geofence');
        $this->addSql('ALTER TABLE location DROP dog_name, DROP speed, CHANGE latitude Latitude DOUBLE PRECISION DEFAULT NULL, CHANGE longitude Longitude DOUBLE PRECISION DEFAULT NULL');
    }
}
