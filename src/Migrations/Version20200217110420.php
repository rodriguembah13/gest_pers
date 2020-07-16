<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200217110420 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE experience_employe (id INT AUTO_INCREMENT NOT NULL, employe_id INT DEFAULT NULL, titre_fonction VARCHAR(255) NOT NULL, employeur VARCHAR(255) NOT NULL, adresse VARCHAR(255) DEFAULT NULL, date_debut DATE DEFAULT NULL, date_fin DATE DEFAULT NULL, INDEX IDX_BD2F382B1B65292 (employe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etude_employe (id INT AUTO_INCREMENT NOT NULL, employe_id INT DEFAULT NULL, nom_etablissement VARCHAR(255) NOT NULL, option_etude VARCHAR(255) DEFAULT NULL, diplome VARCHAR(255) NOT NULL, date DATE DEFAULT NULL, INDEX IDX_9307E6B91B65292 (employe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE experience_employe ADD CONSTRAINT FK_BD2F382B1B65292 FOREIGN KEY (employe_id) REFERENCES employe (id)');
        $this->addSql('ALTER TABLE etude_employe ADD CONSTRAINT FK_9307E6B91B65292 FOREIGN KEY (employe_id) REFERENCES employe (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE experience_employe');
        $this->addSql('DROP TABLE etude_employe');
    }
}
