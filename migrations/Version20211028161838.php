<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211028161838 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE appointment (id INT AUTO_INCREMENT NOT NULL, beneficiary_id INT NOT NULL, service_id INT NOT NULL, canceled TINYINT(1) NOT NULL, starting_time DATETIME NOT NULL, ending_time DATETIME NOT NULL, INDEX IDX_FE38F844ECCAAFA0 (beneficiary_id), INDEX IDX_FE38F844ED5CA9E6 (service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE beneficiary (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_7ABF446AF85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE professional (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, language LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_B3B573AAE7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, professional_id INT NOT NULL, category_id INT NOT NULL, specialization VARCHAR(255) DEFAULT NULL, description LONGTEXT NOT NULL, address_details LONGTEXT DEFAULT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, housenumber VARCHAR(255) DEFAULT NULL, street VARCHAR(255) DEFAULT NULL, county VARCHAR(255) DEFAULT NULL, latitude DOUBLE PRECISION NOT NULL, longitude DOUBLE PRECISION NOT NULL, postcode INT DEFAULT NULL, price_type VARCHAR(255) NOT NULL, price DOUBLE PRECISION DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, address VARCHAR(255) NOT NULL, INDEX IDX_E19D9AD2DB77003 (professional_id), INDEX IDX_E19D9AD212469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, icon VARCHAR(255) DEFAULT NULL, color VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F844ECCAAFA0 FOREIGN KEY (beneficiary_id) REFERENCES beneficiary (id)');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F844ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD2DB77003 FOREIGN KEY (professional_id) REFERENCES professional (id)');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD212469DE2 FOREIGN KEY (category_id) REFERENCES service_category (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F844ECCAAFA0');
        $this->addSql('ALTER TABLE service DROP FOREIGN KEY FK_E19D9AD2DB77003');
        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F844ED5CA9E6');
        $this->addSql('ALTER TABLE service DROP FOREIGN KEY FK_E19D9AD212469DE2');
        $this->addSql('DROP TABLE appointment');
        $this->addSql('DROP TABLE beneficiary');
        $this->addSql('DROP TABLE professional');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE service_category');
    }
}
