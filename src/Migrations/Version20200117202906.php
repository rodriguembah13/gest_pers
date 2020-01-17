<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200117202906 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE rhlignereglepaie (id INT AUTO_INCREMENT NOT NULL, rh_bulletin_paie_id INT DEFAULT NULL, rhreglesalaire_id INT DEFAULT NULL, libelle VARCHAR(255) DEFAULT NULL, quantite INT DEFAULT NULL, total DOUBLE PRECISION DEFAULT NULL, INDEX IDX_F244293DF663DABE (rh_bulletin_paie_id), INDEX IDX_F244293D2F385FBA (rhreglesalaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rhreglesalaire (id INT AUTO_INCREMENT NOT NULL, rhcategorieregle_id INT DEFAULT NULL, libelle VARCHAR(255) DEFAULT NULL, code VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, sequencecalcul INT DEFAULT NULL, isvisible TINYINT(1) DEFAULT NULL, quantite INT DEFAULT NULL, pourcentage INT DEFAULT NULL, montantfixe DOUBLE PRECISION DEFAULT NULL, registrecontribution VARCHAR(255) DEFAULT NULL, plagemin INT DEFAULT NULL, plagemax INT DEFAULT NULL, plagesur VARCHAR(255) DEFAULT NULL, pourcentagesur VARCHAR(255) DEFAULT NULL, codecalcul VARCHAR(255) DEFAULT NULL, rhcondition VARCHAR(255) DEFAULT NULL, typecondition VARCHAR(255) DEFAULT NULL, expression VARCHAR(255) DEFAULT NULL, INDEX IDX_D07883044ADE22ED (rhcategorieregle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rh_bulletin_paie (id INT AUTO_INCREMENT NOT NULL, rhcontrat_id INT DEFAULT NULL, libelle VARCHAR(255) DEFAULT NULL, etat TINYINT(1) DEFAULT NULL, datecreation DATE DEFAULT NULL, datepaie DATE NOT NULL, INDEX IDX_8B672E5A21AC010 (rhcontrat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rhstructuresalaire (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, reference VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rh_categorie_regle (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) DEFAULT NULL, code VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, operation VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rhlignereglestructure (id INT AUTO_INCREMENT NOT NULL, rhstructuresalaire_id INT DEFAULT NULL, rhreglesalaire_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, INDEX IDX_304D1AD618669A43 (rhstructuresalaire_id), INDEX IDX_304D1AD62F385FBA (rhreglesalaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rhlignereglepaie ADD CONSTRAINT FK_F244293DF663DABE FOREIGN KEY (rh_bulletin_paie_id) REFERENCES rh_bulletin_paie (id)');
        $this->addSql('ALTER TABLE rhlignereglepaie ADD CONSTRAINT FK_F244293D2F385FBA FOREIGN KEY (rhreglesalaire_id) REFERENCES rhreglesalaire (id)');
        $this->addSql('ALTER TABLE rhreglesalaire ADD CONSTRAINT FK_D07883044ADE22ED FOREIGN KEY (rhcategorieregle_id) REFERENCES rh_categorie_regle (id)');
        $this->addSql('ALTER TABLE rh_bulletin_paie ADD CONSTRAINT FK_8B672E5A21AC010 FOREIGN KEY (rhcontrat_id) REFERENCES contrat (id)');
        $this->addSql('ALTER TABLE rhlignereglestructure ADD CONSTRAINT FK_304D1AD618669A43 FOREIGN KEY (rhstructuresalaire_id) REFERENCES rhstructuresalaire (id)');
        $this->addSql('ALTER TABLE rhlignereglestructure ADD CONSTRAINT FK_304D1AD62F385FBA FOREIGN KEY (rhreglesalaire_id) REFERENCES rhreglesalaire (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rhlignereglepaie DROP FOREIGN KEY FK_F244293D2F385FBA');
        $this->addSql('ALTER TABLE rhlignereglestructure DROP FOREIGN KEY FK_304D1AD62F385FBA');
        $this->addSql('ALTER TABLE rhlignereglepaie DROP FOREIGN KEY FK_F244293DF663DABE');
        $this->addSql('ALTER TABLE rhlignereglestructure DROP FOREIGN KEY FK_304D1AD618669A43');
        $this->addSql('ALTER TABLE rhreglesalaire DROP FOREIGN KEY FK_D07883044ADE22ED');
        $this->addSql('DROP TABLE rhlignereglepaie');
        $this->addSql('DROP TABLE rhreglesalaire');
        $this->addSql('DROP TABLE rh_bulletin_paie');
        $this->addSql('DROP TABLE rhstructuresalaire');
        $this->addSql('DROP TABLE rh_categorie_regle');
        $this->addSql('DROP TABLE rhlignereglestructure');
    }
}
