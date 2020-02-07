<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200203050339 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE advance_salaire (id INT AUTO_INCREMENT NOT NULL, employe_id INT DEFAULT NULL, user_id INT DEFAULT NULL, libelle VARCHAR(255) DEFAULT NULL, created DATE NOT NULL, montant DOUBLE PRECISION NOT NULL, month INT NOT NULL, year INT NOT NULL, echance INT NOT NULL, INDEX IDX_14A65B431B65292 (employe_id), INDEX IDX_14A65B43A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE advance_salaire_echeance (id INT AUTO_INCREMENT NOT NULL, advance_salaire_id INT DEFAULT NULL, month INT NOT NULL, year INT NOT NULL, montant DOUBLE PRECISION NOT NULL, statut TINYINT(1) NOT NULL, INDEX IDX_3D76BAD0726774FF (advance_salaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE advance_salaire ADD CONSTRAINT FK_14A65B431B65292 FOREIGN KEY (employe_id) REFERENCES employe (id)');
        $this->addSql('ALTER TABLE advance_salaire ADD CONSTRAINT FK_14A65B43A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE advance_salaire_echeance ADD CONSTRAINT FK_3D76BAD0726774FF FOREIGN KEY (advance_salaire_id) REFERENCES advance_salaire (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE advance_salaire_echeance DROP FOREIGN KEY FK_3D76BAD0726774FF');
        $this->addSql('DROP TABLE advance_salaire');
        $this->addSql('DROP TABLE advance_salaire_echeance');
    }
}
