<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200114201131 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ca_type ADD departement_id INT DEFAULT NULL, ADD poste_id INT DEFAULT NULL, ADD entreprise_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ca_type ADD CONSTRAINT FK_F34385D6CCF9E01E FOREIGN KEY (departement_id) REFERENCES departement (id)');
        $this->addSql('ALTER TABLE ca_type ADD CONSTRAINT FK_F34385D6A0905086 FOREIGN KEY (poste_id) REFERENCES poste (id)');
        $this->addSql('ALTER TABLE ca_type ADD CONSTRAINT FK_F34385D6A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('CREATE INDEX IDX_F34385D6CCF9E01E ON ca_type (departement_id)');
        $this->addSql('CREATE INDEX IDX_F34385D6A0905086 ON ca_type (poste_id)');
        $this->addSql('CREATE INDEX IDX_F34385D6A4AEAFEA ON ca_type (entreprise_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ca_type DROP FOREIGN KEY FK_F34385D6CCF9E01E');
        $this->addSql('ALTER TABLE ca_type DROP FOREIGN KEY FK_F34385D6A0905086');
        $this->addSql('ALTER TABLE ca_type DROP FOREIGN KEY FK_F34385D6A4AEAFEA');
        $this->addSql('DROP INDEX IDX_F34385D6CCF9E01E ON ca_type');
        $this->addSql('DROP INDEX IDX_F34385D6A0905086 ON ca_type');
        $this->addSql('DROP INDEX IDX_F34385D6A4AEAFEA ON ca_type');
        $this->addSql('ALTER TABLE ca_type DROP departement_id, DROP poste_id, DROP entreprise_id');
    }
}
