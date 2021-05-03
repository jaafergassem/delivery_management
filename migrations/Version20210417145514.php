<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210417145514 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bordereau DROP FOREIGN KEY FK_F7B4C5613414710B');
        $this->addSql('ALTER TABLE historique DROP FOREIGN KEY FK_EDBFD5EC3414710B');
        $this->addSql('ALTER TABLE paquet DROP FOREIGN KEY FK_D0E9B51A3414710B');
        $this->addSql('CREATE TABLE agent_poste (id INT AUTO_INCREMENT NOT NULL, poste_occupe VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE agentposte');
        $this->addSql('ALTER TABLE bordereau DROP FOREIGN KEY FK_F7B4C5613414710B');
        $this->addSql('ALTER TABLE bordereau CHANGE agent_id agent_id INT DEFAULT NULL, CHANGE transporeteur_id transporeteur_id INT DEFAULT NULL, CHANGE poste_depart_id poste_depart_id INT DEFAULT NULL, CHANGE poste_arrive_id poste_arrive_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bordereau ADD CONSTRAINT FK_F7B4C5613414710B FOREIGN KEY (agent_id) REFERENCES agent_poste (id)');
        $this->addSql('ALTER TABLE historique DROP FOREIGN KEY FK_EDBFD5EC3414710B');
        $this->addSql('ALTER TABLE historique CHANGE transporteur_id transporteur_id INT DEFAULT NULL, CHANGE situation_id situation_id INT DEFAULT NULL, CHANGE paquet_id paquet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE historique ADD CONSTRAINT FK_EDBFD5EC3414710B FOREIGN KEY (agent_id) REFERENCES agent_poste (id)');
        $this->addSql('ALTER TABLE livreur CHANGE intitule intitule VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE paquet DROP FOREIGN KEY FK_D0E9B51A50233D0C');
        $this->addSql('ALTER TABLE paquet DROP FOREIGN KEY FK_D0E9B51A3414710B');
        $this->addSql('DROP INDEX IDX_D0E9B51A50233D0C ON paquet');
        $this->addSql('ALTER TABLE paquet ADD poste_darrive_id INT DEFAULT NULL, DROP poste_arrive_id, CHANGE agent_id agent_id INT DEFAULT NULL, CHANGE poste_depart_id poste_depart_id INT DEFAULT NULL, CHANGE situation_id situation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE paquet ADD CONSTRAINT FK_D0E9B51A5898FAA8 FOREIGN KEY (poste_darrive_id) REFERENCES poste (id)');
        $this->addSql('ALTER TABLE paquet ADD CONSTRAINT FK_D0E9B51A3414710B FOREIGN KEY (agent_id) REFERENCES agent_poste (id)');
        $this->addSql('CREATE INDEX IDX_D0E9B51A5898FAA8 ON paquet (poste_darrive_id)');
        $this->addSql('ALTER TABLE paquet_bordereau CHANGE paquet_id paquet_id INT DEFAULT NULL, CHANGE bordereau_id bordereau_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE transporteur CHANGE camion_id camion_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bordereau DROP FOREIGN KEY FK_F7B4C5613414710B');
        $this->addSql('ALTER TABLE historique DROP FOREIGN KEY FK_EDBFD5EC3414710B');
        $this->addSql('ALTER TABLE paquet DROP FOREIGN KEY FK_D0E9B51A3414710B');
        $this->addSql('CREATE TABLE agentposte (id INT AUTO_INCREMENT NOT NULL, posteOccupe VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE agent_poste');
        $this->addSql('ALTER TABLE bordereau DROP FOREIGN KEY FK_F7B4C5613414710B');
        $this->addSql('ALTER TABLE bordereau CHANGE agent_id agent_id INT DEFAULT NULL, CHANGE transporeteur_id transporeteur_id INT DEFAULT NULL, CHANGE poste_depart_id poste_depart_id INT DEFAULT NULL, CHANGE poste_arrive_id poste_arrive_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bordereau ADD CONSTRAINT FK_F7B4C5613414710B FOREIGN KEY (agent_id) REFERENCES agentposte (id)');
        $this->addSql('ALTER TABLE historique DROP FOREIGN KEY FK_EDBFD5EC3414710B');
        $this->addSql('ALTER TABLE historique CHANGE transporteur_id transporteur_id INT DEFAULT NULL, CHANGE situation_id situation_id INT DEFAULT NULL, CHANGE paquet_id paquet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE historique ADD CONSTRAINT FK_EDBFD5EC3414710B FOREIGN KEY (agent_id) REFERENCES agentposte (id)');
        $this->addSql('ALTER TABLE livreur CHANGE intitule intitule VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE paquet DROP FOREIGN KEY FK_D0E9B51A5898FAA8');
        $this->addSql('ALTER TABLE paquet DROP FOREIGN KEY FK_D0E9B51A3414710B');
        $this->addSql('DROP INDEX IDX_D0E9B51A5898FAA8 ON paquet');
        $this->addSql('ALTER TABLE paquet ADD poste_arrive_id INT DEFAULT NULL, DROP poste_darrive_id, CHANGE agent_id agent_id INT DEFAULT NULL, CHANGE poste_depart_id poste_depart_id INT DEFAULT NULL, CHANGE situation_id situation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE paquet ADD CONSTRAINT FK_D0E9B51A50233D0C FOREIGN KEY (poste_arrive_id) REFERENCES poste (id)');
        $this->addSql('ALTER TABLE paquet ADD CONSTRAINT FK_D0E9B51A3414710B FOREIGN KEY (agent_id) REFERENCES agentposte (id)');
        $this->addSql('CREATE INDEX IDX_D0E9B51A50233D0C ON paquet (poste_arrive_id)');
        $this->addSql('ALTER TABLE paquet_bordereau CHANGE paquet_id paquet_id INT DEFAULT NULL, CHANGE bordereau_id bordereau_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE transporteur CHANGE camion_id camion_id INT DEFAULT NULL');
    }
}
