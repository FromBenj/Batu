<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210910140119 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, category VARCHAR(255) NOT NULL, languages LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', specialization VARCHAR(255) DEFAULT NULL, description LONGTEXT NOT NULL, address VARCHAR(255) NOT NULL, address_details LONGTEXT NOT NULL, price LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', city VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, housenumber VARCHAR(255) DEFAULT NULL, street VARCHAR(255) DEFAULT NULL, county VARCHAR(255) DEFAULT NULL, latitude DOUBLE PRECISION NOT NULL, longitude DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE service');
    }
}
