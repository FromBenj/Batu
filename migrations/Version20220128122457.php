<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220128122457 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE language (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE professional_language (professional_id INT NOT NULL, language_id INT NOT NULL, INDEX IDX_475DAB08DB77003 (professional_id), INDEX IDX_475DAB0882F1BAF4 (language_id), PRIMARY KEY(professional_id, language_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE professional_language ADD CONSTRAINT FK_475DAB08DB77003 FOREIGN KEY (professional_id) REFERENCES professional (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE professional_language ADD CONSTRAINT FK_475DAB0882F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE professional DROP language');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE professional_language DROP FOREIGN KEY FK_475DAB0882F1BAF4');
        $this->addSql('DROP TABLE language');
        $this->addSql('DROP TABLE professional_language');
        $this->addSql('ALTER TABLE professional ADD language LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\'');
    }
}
