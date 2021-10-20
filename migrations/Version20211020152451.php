<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211020152451 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F844ED5CA9E6');
        $this->addSql('DROP INDEX UNIQ_FE38F844ED5CA9E6 ON appointment');
        $this->addSql('ALTER TABLE appointment CHANGE service_id professional_id INT NOT NULL');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F844DB77003 FOREIGN KEY (professional_id) REFERENCES professional (id)');
        $this->addSql('CREATE INDEX IDX_FE38F844DB77003 ON appointment (professional_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F844DB77003');
        $this->addSql('DROP INDEX IDX_FE38F844DB77003 ON appointment');
        $this->addSql('ALTER TABLE appointment CHANGE professional_id service_id INT NOT NULL');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F844ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FE38F844ED5CA9E6 ON appointment (service_id)');
    }
}
