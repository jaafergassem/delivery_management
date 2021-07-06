<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210705160114 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE historique (id INT AUTO_INCREMENT NOT NULL, agent_id INT NOT NULL, situation_id INT DEFAULT NULL, paquet_id INT DEFAULT NULL, etat VARCHAR(255) NOT NULL, statut VARCHAR(255) NOT NULL, date DATE NOT NULL, INDEX IDX_EDBFD5EC3414710B (agent_id), INDEX IDX_EDBFD5EC3408E8AF (situation_id), INDEX IDX_EDBFD5EC3794E367 (paquet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE historique ADD CONSTRAINT FK_EDBFD5EC3414710B FOREIGN KEY (agent_id) REFERENCES agent_poste (id)');
        $this->addSql('ALTER TABLE historique ADD CONSTRAINT FK_EDBFD5EC3408E8AF FOREIGN KEY (situation_id) REFERENCES poste (id)');
        $this->addSql('ALTER TABLE historique ADD CONSTRAINT FK_EDBFD5EC3794E367 FOREIGN KEY (paquet_id) REFERENCES paquet (id)');
        $this->addSql('DROP TABLE agent_poste_poste');
        $this->addSql('ALTER TABLE agent_poste CHANGE poste_id poste_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bordereau DROP FOREIGN KEY FK_F7B4C56197C86FA4');
        $this->addSql('DROP INDEX IDX_F7B4C56197C86FA4 ON bordereau');
        $this->addSql('ALTER TABLE bordereau DROP transporteur_id, CHANGE agent_id agent_id INT DEFAULT NULL, CHANGE poste_depart_id poste_depart_id INT DEFAULT NULL, CHANGE poste_arrive_id poste_arrive_id INT DEFAULT NULL, CHANGE camion_id camion_id INT DEFAULT NULL, CHANGE num_bordereau num_bordereau VARCHAR(255) DEFAULT NULL, CHANGE date_creation date_creation DATETIME DEFAULT NULL, CHANGE date_arrive date_arrive DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE livreur DROP FOREIGN KEY FK_EB7A4E6D3A706D3');
        $this->addSql('DROP INDEX UNIQ_EB7A4E6D3A706D3 ON livreur');
        $this->addSql('ALTER TABLE livreur DROP camion_id, CHANGE intitule intitule VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE paquet CHANGE agent_id agent_id INT DEFAULT NULL, CHANGE poste_depart_id poste_depart_id INT DEFAULT NULL, CHANGE poste_arrive_id poste_arrive_id INT DEFAULT NULL, CHANGE situation_id situation_id INT DEFAULT NULL, CHANGE date_depart date_depart DATE DEFAULT NULL, CHANGE date_creation date_creation DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE paquet_bordereau CHANGE paquet_id paquet_id INT DEFAULT NULL, CHANGE bordereau_id bordereau_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE transporteur DROP INDEX IDX_A25649753A706D3, ADD UNIQUE INDEX UNIQ_A25649753A706D3 (camion_id)');
        $this->addSql('ALTER TABLE transporteur DROP INDEX IDX_A2564975F8646701, ADD UNIQUE INDEX UNIQ_A2564975F8646701 (livreur_id)');
        $this->addSql('ALTER TABLE transporteur ADD affectation TINYINT(1) NOT NULL, CHANGE livreur_id livreur_id INT DEFAULT NULL, CHANGE camion_id camion_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE agent_poste_poste (agent_poste_id INT NOT NULL, poste_id INT NOT NULL, INDEX IDX_5A4EA60E96414912 (agent_poste_id), INDEX IDX_5A4EA60EA0905086 (poste_id), PRIMARY KEY(agent_poste_id, poste_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE agent_poste_poste ADD CONSTRAINT FK_5A4EA60E96414912 FOREIGN KEY (agent_poste_id) REFERENCES agent_poste (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE agent_poste_poste ADD CONSTRAINT FK_5A4EA60EA0905086 FOREIGN KEY (poste_id) REFERENCES poste (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE historique');
        $this->addSql('ALTER TABLE agent_poste CHANGE poste_id poste_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bordereau ADD transporteur_id INT DEFAULT NULL, CHANGE agent_id agent_id INT DEFAULT NULL, CHANGE poste_depart_id poste_depart_id INT DEFAULT NULL, CHANGE poste_arrive_id poste_arrive_id INT DEFAULT NULL, CHANGE camion_id camion_id INT DEFAULT NULL, CHANGE num_bordereau num_bordereau VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE date_creation date_creation DATETIME DEFAULT \'NULL\', CHANGE date_arrive date_arrive DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE bordereau ADD CONSTRAINT FK_F7B4C56197C86FA4 FOREIGN KEY (transporteur_id) REFERENCES transporteur (id)');
        $this->addSql('CREATE INDEX IDX_F7B4C56197C86FA4 ON bordereau (transporteur_id)');
        $this->addSql('ALTER TABLE livreur ADD camion_id INT DEFAULT NULL, CHANGE intitule intitule VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE livreur ADD CONSTRAINT FK_EB7A4E6D3A706D3 FOREIGN KEY (camion_id) REFERENCES camion (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EB7A4E6D3A706D3 ON livreur (camion_id)');
        $this->addSql('ALTER TABLE paquet CHANGE agent_id agent_id INT DEFAULT NULL, CHANGE poste_depart_id poste_depart_id INT DEFAULT NULL, CHANGE poste_arrive_id poste_arrive_id INT DEFAULT NULL, CHANGE situation_id situation_id INT DEFAULT NULL, CHANGE date_depart date_depart DATE DEFAULT \'NULL\', CHANGE date_creation date_creation DATE DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE paquet_bordereau CHANGE paquet_id paquet_id INT DEFAULT NULL, CHANGE bordereau_id bordereau_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE transporteur DROP INDEX UNIQ_A2564975F8646701, ADD INDEX IDX_A2564975F8646701 (livreur_id)');
        $this->addSql('ALTER TABLE transporteur DROP INDEX UNIQ_A25649753A706D3, ADD INDEX IDX_A25649753A706D3 (camion_id)');
        $this->addSql('ALTER TABLE transporteur DROP affectation, CHANGE livreur_id livreur_id INT NOT NULL, CHANGE camion_id camion_id INT DEFAULT NULL');
    }
}
