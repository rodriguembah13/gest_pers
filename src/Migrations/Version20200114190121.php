<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200114190121 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ca_conge ADD type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ca_conge ADD CONSTRAINT FK_3A5E117C54C8C93 FOREIGN KEY (type_id) REFERENCES ca_type (id)');
        $this->addSql('CREATE INDEX IDX_3A5E117C54C8C93 ON ca_conge (type_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ca_conge DROP FOREIGN KEY FK_3A5E117C54C8C93');
        $this->addSql('DROP INDEX IDX_3A5E117C54C8C93 ON ca_conge');
        $this->addSql('ALTER TABLE ca_conge DROP type_id');
    }
}
