<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220131152548 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appointment CHANGE beneficiary_id beneficiary_id INT DEFAULT NULL');
        $this->addSql('DROP INDEX UNIQ_7ABF446AF85E0677 ON beneficiary');
        $this->addSql('ALTER TABLE beneficiary ADD user_id INT NOT NULL, DROP username, DROP roles, DROP password');
        $this->addSql('ALTER TABLE beneficiary ADD CONSTRAINT FK_7ABF446AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7ABF446AA76ED395 ON beneficiary (user_id)');
        $this->addSql('ALTER TABLE professional ADD user_id INT NOT NULL, DROP roles, DROP password, DROP username');
        $this->addSql('ALTER TABLE professional ADD CONSTRAINT FK_B3B573AAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B3B573AAA76ED395 ON professional (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appointment CHANGE beneficiary_id beneficiary_id INT NOT NULL');
        $this->addSql('ALTER TABLE beneficiary DROP FOREIGN KEY FK_7ABF446AA76ED395');
        $this->addSql('DROP INDEX UNIQ_7ABF446AA76ED395 ON beneficiary');
        $this->addSql('ALTER TABLE beneficiary ADD username VARCHAR(180) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD roles JSON NOT NULL, ADD password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP user_id');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7ABF446AF85E0677 ON beneficiary (username)');
        $this->addSql('ALTER TABLE professional DROP FOREIGN KEY FK_B3B573AAA76ED395');
        $this->addSql('DROP INDEX UNIQ_B3B573AAA76ED395 ON professional');
        $this->addSql('ALTER TABLE professional ADD roles JSON NOT NULL, ADD password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD username VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP user_id');
    }
}
