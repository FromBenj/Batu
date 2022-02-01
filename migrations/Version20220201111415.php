<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220201111415 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE beneficiary DROP user_id');
        $this->addSql('ALTER TABLE professional DROP roles, DROP password, DROP username');
        $this->addSql('ALTER TABLE user ADD beneficiary_id INT DEFAULT NULL, ADD professional_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649ECCAAFA0 FOREIGN KEY (beneficiary_id) REFERENCES beneficiary (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649DB77003 FOREIGN KEY (professional_id) REFERENCES professional (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649ECCAAFA0 ON user (beneficiary_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649DB77003 ON user (professional_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE beneficiary ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE professional ADD roles JSON NOT NULL, ADD password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD username VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649ECCAAFA0');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649DB77003');
        $this->addSql('DROP INDEX UNIQ_8D93D649ECCAAFA0 ON user');
        $this->addSql('DROP INDEX UNIQ_8D93D649DB77003 ON user');
        $this->addSql('ALTER TABLE user DROP beneficiary_id, DROP professional_id');
    }
}
