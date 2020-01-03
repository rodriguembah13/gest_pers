<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200103110616 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE type_contrat (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE poste (id INT AUTO_INCREMENT NOT NULL, departement_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, INDEX IDX_7C890FABCCF9E01E (departement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contrat (id INT AUTO_INCREMENT NOT NULL, employe_id INT DEFAULT NULL, type_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, date_debut DATE NOT NULL, date_fin VARCHAR(255) NOT NULL, fin_essai DATE NOT NULL, salaire INT NOT NULL, satut VARCHAR(255) NOT NULL, INDEX IDX_603499931B65292 (employe_id), INDEX IDX_60349993C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entreprise (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employe (id INT AUTO_INCREMENT NOT NULL, poste_id INT DEFAULT NULL, compte_id INT DEFAULT NULL, nom_complet VARCHAR(255) NOT NULL, matricule VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, nationalite VARCHAR(255) NOT NULL, cni VARCHAR(255) NOT NULL, passeport VARCHAR(255) NOT NULL, sexe VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, lieu_naissance VARCHAR(255) NOT NULL, etat_civil VARCHAR(255) NOT NULL, note_additionnelle VARCHAR(255) NOT NULL, INDEX IDX_F804D3B9A0905086 (poste_id), UNIQUE INDEX UNIQ_F804D3B9F2C56620 (compte_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE departement (id INT AUTO_INCREMENT NOT NULL, entreprise_id INT DEFAULT NULL, responsable_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, INDEX IDX_C1765B63A4AEAFEA (entreprise_id), UNIQUE INDEX UNIQ_C1765B6353C59D72 (responsable_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_1483A5E992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_1483A5E9A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_1483A5E9C05FB297 (confirmation_token), UNIQUE INDEX UNIQ_1483A5E9F85E0677 (username), UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE poste ADD CONSTRAINT FK_7C890FABCCF9E01E FOREIGN KEY (departement_id) REFERENCES departement (id)');
        $this->addSql('ALTER TABLE contrat ADD CONSTRAINT FK_603499931B65292 FOREIGN KEY (employe_id) REFERENCES employe (id)');
        $this->addSql('ALTER TABLE contrat ADD CONSTRAINT FK_60349993C54C8C93 FOREIGN KEY (type_id) REFERENCES type_contrat (id)');
        $this->addSql('ALTER TABLE employe ADD CONSTRAINT FK_F804D3B9A0905086 FOREIGN KEY (poste_id) REFERENCES poste (id)');
        $this->addSql('ALTER TABLE employe ADD CONSTRAINT FK_F804D3B9F2C56620 FOREIGN KEY (compte_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE departement ADD CONSTRAINT FK_C1765B63A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE departement ADD CONSTRAINT FK_C1765B6353C59D72 FOREIGN KEY (responsable_id) REFERENCES employe (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE contrat DROP FOREIGN KEY FK_60349993C54C8C93');
        $this->addSql('ALTER TABLE employe DROP FOREIGN KEY FK_F804D3B9A0905086');
        $this->addSql('ALTER TABLE departement DROP FOREIGN KEY FK_C1765B63A4AEAFEA');
        $this->addSql('ALTER TABLE contrat DROP FOREIGN KEY FK_603499931B65292');
        $this->addSql('ALTER TABLE departement DROP FOREIGN KEY FK_C1765B6353C59D72');
        $this->addSql('ALTER TABLE poste DROP FOREIGN KEY FK_7C890FABCCF9E01E');
        $this->addSql('ALTER TABLE employe DROP FOREIGN KEY FK_F804D3B9F2C56620');
        $this->addSql('DROP TABLE type_contrat');
        $this->addSql('DROP TABLE poste');
        $this->addSql('DROP TABLE contrat');
        $this->addSql('DROP TABLE entreprise');
        $this->addSql('DROP TABLE employe');
        $this->addSql('DROP TABLE departement');
        $this->addSql('DROP TABLE users');
    }
}
