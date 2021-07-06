<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210703123943 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE agent_poste_poste');
        $this->addSql('ALTER TABLE agent_poste CHANGE poste_id poste_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bordereau CHANGE agent_id agent_id INT DEFAULT NULL, CHANGE poste_depart_id poste_depart_id INT DEFAULT NULL, CHANGE poste_arrive_id poste_arrive_id INT DEFAULT NULL, CHANGE transporteur_id transporteur_id INT DEFAULT NULL, CHANGE camion_id camion_id INT DEFAULT NULL, CHANGE num_bordereau num_bordereau VARCHAR(255) DEFAULT NULL, CHANGE date_creation date_creation DATETIME DEFAULT NULL, CHANGE date_arrive date_arrive DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE historique CHANGE transporteur_id transporteur_id INT DEFAULT NULL, CHANGE situation_id situation_id INT DEFAULT NULL, CHANGE paquet_id paquet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE livreur DROP FOREIGN KEY FK_EB7A4E6D3A706D3');
        $this->addSql('DROP INDEX IDX_EB7A4E6D3A706D3 ON livreur');
        $this->addSql('ALTER TABLE livreur DROP camion_id, CHANGE intitule intitule VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE paquet CHANGE agent_id agent_id INT DEFAULT NULL, CHANGE poste_depart_id poste_depart_id INT DEFAULT NULL, CHANGE poste_arrive_id poste_arrive_id INT DEFAULT NULL, CHANGE situation_id situation_id INT DEFAULT NULL, CHANGE date_depart date_depart DATE DEFAULT NULL, CHANGE date_creation date_creation DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE paquet_bordereau CHANGE paquet_id paquet_id INT DEFAULT NULL, CHANGE bordereau_id bordereau_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE transporteur CHANGE camion_id camion_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE agent_poste_poste (agent_poste_id INT NOT NULL, poste_id INT NOT NULL, INDEX IDX_5A4EA60EA0905086 (poste_id), INDEX IDX_5A4EA60E96414912 (agent_poste_id), PRIMARY KEY(agent_poste_id, poste_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE agent_poste_poste ADD CONSTRAINT FK_5A4EA60E96414912 FOREIGN KEY (agent_poste_id) REFERENCES agent_poste (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE agent_poste_poste ADD CONSTRAINT FK_5A4EA60EA0905086 FOREIGN KEY (poste_id) REFERENCES poste (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE agent_poste CHANGE poste_id poste_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bordereau CHANGE agent_id agent_id INT DEFAULT NULL, CHANGE transporteur_id transporteur_id INT DEFAULT NULL, CHANGE poste_depart_id poste_depart_id INT DEFAULT NULL, CHANGE poste_arrive_id poste_arrive_id INT DEFAULT NULL, CHANGE camion_id camion_id INT DEFAULT NULL, CHANGE num_bordereau num_bordereau VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE date_creation date_creation DATE DEFAULT \'NULL\', CHANGE date_arrive date_arrive DATE DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE historique CHANGE transporteur_id transporteur_id INT DEFAULT NULL, CHANGE situation_id situation_id INT DEFAULT NULL, CHANGE paquet_id paquet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE livreur ADD camion_id INT DEFAULT NULL, CHANGE intitule intitule VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE livreur ADD CONSTRAINT FK_EB7A4E6D3A706D3 FOREIGN KEY (camion_id) REFERENCES camion (id)');
        $this->addSql('CREATE INDEX IDX_EB7A4E6D3A706D3 ON livreur (camion_id)');
        $this->addSql('ALTER TABLE paquet CHANGE agent_id agent_id INT DEFAULT NULL, CHANGE poste_depart_id poste_depart_id INT DEFAULT NULL, CHANGE poste_arrive_id poste_arrive_id INT DEFAULT NULL, CHANGE situation_id situation_id INT DEFAULT NULL, CHANGE date_depart date_depart DATE DEFAULT \'NULL\', CHANGE date_creation date_creation DATE DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE paquet_bordereau CHANGE paquet_id paquet_id INT DEFAULT NULL, CHANGE bordereau_id bordereau_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE transporteur CHANGE camion_id camion_id INT DEFAULT NULL');
    }
}
