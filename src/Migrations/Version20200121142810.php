<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200121142810 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rh_bulletin_paie ADD employe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rh_bulletin_paie ADD CONSTRAINT FK_8B672E51B65292 FOREIGN KEY (employe_id) REFERENCES employe (id)');
        $this->addSql('CREATE INDEX IDX_8B672E51B65292 ON rh_bulletin_paie (employe_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rh_bulletin_paie DROP FOREIGN KEY FK_8B672E51B65292');
        $this->addSql('DROP INDEX IDX_8B672E51B65292 ON rh_bulletin_paie');
        $this->addSql('ALTER TABLE rh_bulletin_paie DROP employe_id');
    }
}
