<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210602104044 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bordereau CHANGE agent_id agent_id INT DEFAULT NULL, CHANGE transporeteur_id transporeteur_id INT DEFAULT NULL, CHANGE poste_depart_id poste_depart_id INT DEFAULT NULL, CHANGE poste_arrive_id poste_arrive_id INT DEFAULT NULL, CHANGE date_creation date_creation VARCHAR(255) NOT NULL, CHANGE date_arrive date_arrive VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE historique CHANGE transporteur_id transporteur_id INT DEFAULT NULL, CHANGE situation_id situation_id INT DEFAULT NULL, CHANGE paquet_id paquet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE livreur ADD nom VARCHAR(255) NOT NULL, ADD prenom VARCHAR(255) NOT NULL, ADD num_telephone INT NOT NULL, ADD mot_passe VARCHAR(255) NOT NULL, ADD adresse_mail VARCHAR(255) NOT NULL, ADD cin INT NOT NULL, CHANGE intitule intitule VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE paquet CHANGE agent_id agent_id INT DEFAULT NULL, CHANGE poste_depart_id poste_depart_id INT DEFAULT NULL, CHANGE poste_arrive_id poste_arrive_id INT DEFAULT NULL, CHANGE situation_id situation_id INT DEFAULT NULL, CHANGE date_depart date_depart VARCHAR(255) NOT NULL, CHANGE date_creation date_creation VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE paquet_bordereau CHANGE paquet_id paquet_id INT DEFAULT NULL, CHANGE bordereau_id bordereau_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE transporteur CHANGE camion_id camion_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bordereau CHANGE agent_id agent_id INT DEFAULT NULL, CHANGE transporeteur_id transporeteur_id INT DEFAULT NULL, CHANGE poste_depart_id poste_depart_id INT DEFAULT NULL, CHANGE poste_arrive_id poste_arrive_id INT DEFAULT NULL, CHANGE date_creation date_creation DATE NOT NULL, CHANGE date_arrive date_arrive DATE NOT NULL');
        $this->addSql('ALTER TABLE historique CHANGE transporteur_id transporteur_id INT DEFAULT NULL, CHANGE situation_id situation_id INT DEFAULT NULL, CHANGE paquet_id paquet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE livreur DROP nom, DROP prenom, DROP num_telephone, DROP mot_passe, DROP adresse_mail, DROP cin, CHANGE intitule intitule VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE paquet CHANGE agent_id agent_id INT DEFAULT NULL, CHANGE poste_depart_id poste_depart_id INT DEFAULT NULL, CHANGE poste_arrive_id poste_arrive_id INT DEFAULT NULL, CHANGE situation_id situation_id INT DEFAULT NULL, CHANGE date_depart date_depart DATE NOT NULL, CHANGE date_creation date_creation DATE NOT NULL');
        $this->addSql('ALTER TABLE paquet_bordereau CHANGE paquet_id paquet_id INT DEFAULT NULL, CHANGE bordereau_id bordereau_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE transporteur CHANGE camion_id camion_id INT DEFAULT NULL');
    }
}
