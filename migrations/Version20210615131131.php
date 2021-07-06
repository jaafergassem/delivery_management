<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210615131131 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE administrateur (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE agent_poste (id INT NOT NULL, poste_occupe VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bordereau (id INT AUTO_INCREMENT NOT NULL, agent_id INT DEFAULT NULL, transporeteur_id INT DEFAULT NULL, poste_depart_id INT DEFAULT NULL, poste_arrive_id INT DEFAULT NULL, num_bordereau INT NOT NULL, date_creation VARCHAR(255) NOT NULL, date_arrive VARCHAR(255) NOT NULL, statut VARCHAR(255) NOT NULL, INDEX IDX_F7B4C5613414710B (agent_id), INDEX IDX_F7B4C5614EAF0D9A (transporeteur_id), INDEX IDX_F7B4C561A23450F (poste_depart_id), INDEX IDX_F7B4C56150233D0C (poste_arrive_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE camion (id INT AUTO_INCREMENT NOT NULL, matricule_camion VARCHAR(255) NOT NULL, intitule VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE historique (id INT AUTO_INCREMENT NOT NULL, agent_id INT NOT NULL, transporteur_id INT DEFAULT NULL, situation_id INT DEFAULT NULL, paquet_id INT DEFAULT NULL, etat VARCHAR(255) NOT NULL, statut VARCHAR(255) NOT NULL, date DATE NOT NULL, INDEX IDX_EDBFD5EC3414710B (agent_id), INDEX IDX_EDBFD5EC97C86FA4 (transporteur_id), INDEX IDX_EDBFD5EC3408E8AF (situation_id), INDEX IDX_EDBFD5EC3794E367 (paquet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livreur (id INT NOT NULL, intitule VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE paquet (id INT AUTO_INCREMENT NOT NULL, agent_id INT DEFAULT NULL, poste_depart_id INT DEFAULT NULL, poste_arrive_id INT DEFAULT NULL, situation_id INT DEFAULT NULL, code_barre INT NOT NULL, date_depart DATE NOT NULL, statut VARCHAR(255) NOT NULL, date_creation DATE NOT NULL, type VARCHAR(255) NOT NULL, designation VARCHAR(255) NOT NULL, INDEX IDX_D0E9B51A3414710B (agent_id), INDEX IDX_D0E9B51AA23450F (poste_depart_id), INDEX IDX_D0E9B51A50233D0C (poste_arrive_id), INDEX IDX_D0E9B51A3408E8AF (situation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE paquet_bordereau (id INT AUTO_INCREMENT NOT NULL, paquet_id INT DEFAULT NULL, bordereau_id INT DEFAULT NULL, statut VARCHAR(255) NOT NULL, INDEX IDX_BF0BCD803794E367 (paquet_id), INDEX IDX_BF0BCD8055D5304E (bordereau_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE poste (id INT AUTO_INCREMENT NOT NULL, localisation VARCHAR(255) NOT NULL, nom_poste VARCHAR(255) NOT NULL, numero_telephone INT NOT NULL, etat VARCHAR(255) NOT NULL, code_postal INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transporteur (id INT AUTO_INCREMENT NOT NULL, livreur_id INT NOT NULL, camion_id INT DEFAULT NULL, INDEX IDX_A2564975F8646701 (livreur_id), INDEX IDX_A25649753A706D3 (camion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, num_telephone INT NOT NULL, mot_passe VARCHAR(255) NOT NULL, adresse_mail VARCHAR(255) NOT NULL, cin INT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE administrateur ADD CONSTRAINT FK_32EB52E8BF396750 FOREIGN KEY (id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE agent_poste ADD CONSTRAINT FK_452727D3BF396750 FOREIGN KEY (id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE bordereau ADD CONSTRAINT FK_F7B4C5613414710B FOREIGN KEY (agent_id) REFERENCES agent_poste (id)');
        $this->addSql('ALTER TABLE bordereau ADD CONSTRAINT FK_F7B4C5614EAF0D9A FOREIGN KEY (transporeteur_id) REFERENCES transporteur (id)');
        $this->addSql('ALTER TABLE bordereau ADD CONSTRAINT FK_F7B4C561A23450F FOREIGN KEY (poste_depart_id) REFERENCES poste (id)');
        $this->addSql('ALTER TABLE bordereau ADD CONSTRAINT FK_F7B4C56150233D0C FOREIGN KEY (poste_arrive_id) REFERENCES poste (id)');
        $this->addSql('ALTER TABLE historique ADD CONSTRAINT FK_EDBFD5EC3414710B FOREIGN KEY (agent_id) REFERENCES agent_poste (id)');
        $this->addSql('ALTER TABLE historique ADD CONSTRAINT FK_EDBFD5EC97C86FA4 FOREIGN KEY (transporteur_id) REFERENCES transporteur (id)');
        $this->addSql('ALTER TABLE historique ADD CONSTRAINT FK_EDBFD5EC3408E8AF FOREIGN KEY (situation_id) REFERENCES poste (id)');
        $this->addSql('ALTER TABLE historique ADD CONSTRAINT FK_EDBFD5EC3794E367 FOREIGN KEY (paquet_id) REFERENCES paquet (id)');
        $this->addSql('ALTER TABLE livreur ADD CONSTRAINT FK_EB7A4E6DBF396750 FOREIGN KEY (id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE paquet ADD CONSTRAINT FK_D0E9B51A3414710B FOREIGN KEY (agent_id) REFERENCES agent_poste (id)');
        $this->addSql('ALTER TABLE paquet ADD CONSTRAINT FK_D0E9B51AA23450F FOREIGN KEY (poste_depart_id) REFERENCES poste (id)');
        $this->addSql('ALTER TABLE paquet ADD CONSTRAINT FK_D0E9B51A50233D0C FOREIGN KEY (poste_arrive_id) REFERENCES poste (id)');
        $this->addSql('ALTER TABLE paquet ADD CONSTRAINT FK_D0E9B51A3408E8AF FOREIGN KEY (situation_id) REFERENCES poste (id)');
        $this->addSql('ALTER TABLE paquet_bordereau ADD CONSTRAINT FK_BF0BCD803794E367 FOREIGN KEY (paquet_id) REFERENCES paquet (id)');
        $this->addSql('ALTER TABLE paquet_bordereau ADD CONSTRAINT FK_BF0BCD8055D5304E FOREIGN KEY (bordereau_id) REFERENCES bordereau (id)');
        $this->addSql('ALTER TABLE transporteur ADD CONSTRAINT FK_A2564975F8646701 FOREIGN KEY (livreur_id) REFERENCES livreur (id)');
        $this->addSql('ALTER TABLE transporteur ADD CONSTRAINT FK_A25649753A706D3 FOREIGN KEY (camion_id) REFERENCES camion (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bordereau DROP FOREIGN KEY FK_F7B4C5613414710B');
        $this->addSql('ALTER TABLE historique DROP FOREIGN KEY FK_EDBFD5EC3414710B');
        $this->addSql('ALTER TABLE paquet DROP FOREIGN KEY FK_D0E9B51A3414710B');
        $this->addSql('ALTER TABLE paquet_bordereau DROP FOREIGN KEY FK_BF0BCD8055D5304E');
        $this->addSql('ALTER TABLE transporteur DROP FOREIGN KEY FK_A25649753A706D3');
        $this->addSql('ALTER TABLE transporteur DROP FOREIGN KEY FK_A2564975F8646701');
        $this->addSql('ALTER TABLE historique DROP FOREIGN KEY FK_EDBFD5EC3794E367');
        $this->addSql('ALTER TABLE paquet_bordereau DROP FOREIGN KEY FK_BF0BCD803794E367');
        $this->addSql('ALTER TABLE bordereau DROP FOREIGN KEY FK_F7B4C561A23450F');
        $this->addSql('ALTER TABLE bordereau DROP FOREIGN KEY FK_F7B4C56150233D0C');
        $this->addSql('ALTER TABLE historique DROP FOREIGN KEY FK_EDBFD5EC3408E8AF');
        $this->addSql('ALTER TABLE paquet DROP FOREIGN KEY FK_D0E9B51AA23450F');
        $this->addSql('ALTER TABLE paquet DROP FOREIGN KEY FK_D0E9B51A50233D0C');
        $this->addSql('ALTER TABLE paquet DROP FOREIGN KEY FK_D0E9B51A3408E8AF');
        $this->addSql('ALTER TABLE bordereau DROP FOREIGN KEY FK_F7B4C5614EAF0D9A');
        $this->addSql('ALTER TABLE historique DROP FOREIGN KEY FK_EDBFD5EC97C86FA4');
        $this->addSql('ALTER TABLE administrateur DROP FOREIGN KEY FK_32EB52E8BF396750');
        $this->addSql('ALTER TABLE agent_poste DROP FOREIGN KEY FK_452727D3BF396750');
        $this->addSql('ALTER TABLE livreur DROP FOREIGN KEY FK_EB7A4E6DBF396750');
        $this->addSql('DROP TABLE administrateur');
        $this->addSql('DROP TABLE agent_poste');
        $this->addSql('DROP TABLE bordereau');
        $this->addSql('DROP TABLE camion');
        $this->addSql('DROP TABLE historique');
        $this->addSql('DROP TABLE livreur');
        $this->addSql('DROP TABLE paquet');
        $this->addSql('DROP TABLE paquet_bordereau');
        $this->addSql('DROP TABLE poste');
        $this->addSql('DROP TABLE transporteur');
        $this->addSql('DROP TABLE utilisateur');
    }
}
