<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200218015119 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, customer_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, date_debut DATE DEFAULT NULL, date_fin DATE DEFAULT NULL, INDEX IDX_2FB3D0EE9395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE activity (id INT AUTO_INCREMENT NOT NULL, project_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, visible TINYINT(1) NOT NULL, INDEX IDX_AC74095A166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, teamlead_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, INDEX IDX_C4E0A61F8F7DE5D7 (teamlead_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team_employe (team_id INT NOT NULL, employe_id INT NOT NULL, INDEX IDX_77DA28E296CD8AE (team_id), INDEX IDX_77DA28E1B65292 (employe_id), PRIMARY KEY(team_id, employe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team_project (team_id INT NOT NULL, project_id INT NOT NULL, INDEX IDX_D0CAA1D9296CD8AE (team_id), INDEX IDX_D0CAA1D9166D1F9C (project_id), PRIMARY KEY(team_id, project_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, currency_id INT DEFAULT NULL, nom_complet VARCHAR(255) NOT NULL, company VARCHAR(255) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, country VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) DEFAULT NULL, fax VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, INDEX IDX_81398E0938248176 (currency_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE timesheet (id INT AUTO_INCREMENT NOT NULL, project_id INT DEFAULT NULL, activity_id INT DEFAULT NULL, employe_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, date_debut DATE DEFAULT NULL, date_fin DATE DEFAULT NULL, duration INT DEFAULT NULL, INDEX IDX_77A4E8D4166D1F9C (project_id), INDEX IDX_77A4E8D481C06096 (activity_id), INDEX IDX_77A4E8D41B65292 (employe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE activity ADD CONSTRAINT FK_AC74095A166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61F8F7DE5D7 FOREIGN KEY (teamlead_id) REFERENCES employe (id)');
        $this->addSql('ALTER TABLE team_employe ADD CONSTRAINT FK_77DA28E296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team_employe ADD CONSTRAINT FK_77DA28E1B65292 FOREIGN KEY (employe_id) REFERENCES employe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team_project ADD CONSTRAINT FK_D0CAA1D9296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE team_project ADD CONSTRAINT FK_D0CAA1D9166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E0938248176 FOREIGN KEY (currency_id) REFERENCES currency (id)');
        $this->addSql('ALTER TABLE timesheet ADD CONSTRAINT FK_77A4E8D4166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE timesheet ADD CONSTRAINT FK_77A4E8D481C06096 FOREIGN KEY (activity_id) REFERENCES activity (id)');
        $this->addSql('ALTER TABLE timesheet ADD CONSTRAINT FK_77A4E8D41B65292 FOREIGN KEY (employe_id) REFERENCES employe (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE activity DROP FOREIGN KEY FK_AC74095A166D1F9C');
        $this->addSql('ALTER TABLE team_project DROP FOREIGN KEY FK_D0CAA1D9166D1F9C');
        $this->addSql('ALTER TABLE timesheet DROP FOREIGN KEY FK_77A4E8D4166D1F9C');
        $this->addSql('ALTER TABLE timesheet DROP FOREIGN KEY FK_77A4E8D481C06096');
        $this->addSql('ALTER TABLE team_employe DROP FOREIGN KEY FK_77DA28E296CD8AE');
        $this->addSql('ALTER TABLE team_project DROP FOREIGN KEY FK_D0CAA1D9296CD8AE');
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EE9395C3F3');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE activity');
        $this->addSql('DROP TABLE team');
        $this->addSql('DROP TABLE team_employe');
        $this->addSql('DROP TABLE team_project');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE timesheet');
    }
}
