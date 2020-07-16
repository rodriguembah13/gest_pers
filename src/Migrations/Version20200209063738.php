<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200209063738 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE work_day (id INT AUTO_INCREMENT NOT NULL, entreprise_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, heure_debut TIME DEFAULT NULL, heure_fin TIME DEFAULT NULL, nombre_heure INT DEFAULT NULL, INDEX IDX_9FCE7E0CA4AEAFEA (entreprise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE currency (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, code VARCHAR(255) DEFAULT NULL, status TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE work_day ADD CONSTRAINT FK_9FCE7E0CA4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE entreprise ADD directeur VARCHAR(255) DEFAULT NULL, ADD capital DOUBLE PRECISION DEFAULT NULL, ADD fax VARCHAR(255) DEFAULT NULL, ADD email VARCHAR(255) DEFAULT NULL, ADD date_autorisation DATE DEFAULT NULL, ADD autorisation VARCHAR(255) DEFAULT NULL, ADD pays VARCHAR(255) DEFAULT NULL, ADD ville VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE employe CHANGE nom_complet nom_complet VARCHAR(255) NOT NULL, CHANGE matricule matricule VARCHAR(255) NOT NULL, CHANGE telephone telephone VARCHAR(255) NOT NULL, CHANGE adresse adresse VARCHAR(255) NOT NULL, CHANGE email email VARCHAR(255) NOT NULL, CHANGE nationalite nationalite VARCHAR(255) NOT NULL, CHANGE cni cni VARCHAR(255) NOT NULL, CHANGE passeport passeport VARCHAR(255) NOT NULL, CHANGE lieu_naissance lieu_naissance VARCHAR(255) NOT NULL, CHANGE note_additionnelle note_additionnelle VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE work_day');
        $this->addSql('DROP TABLE currency');
        $this->addSql('ALTER TABLE employe CHANGE nom_complet nom_complet VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE matricule matricule VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE telephone telephone VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE adresse adresse VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE email email VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nationalite nationalite VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE cni cni VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE passeport passeport VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE lieu_naissance lieu_naissance VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE note_additionnelle note_additionnelle VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE entreprise DROP directeur, DROP capital, DROP fax, DROP email, DROP date_autorisation, DROP autorisation, DROP pays, DROP ville');
    }
}
