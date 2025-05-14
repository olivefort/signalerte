<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250507124243 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ars (id INT AUTO_INCREMENT NOT NULL, date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', note INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, signalement_id INT NOT NULL, type VARCHAR(255) NOT NULL, date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_4C62E63865C5E57E (signalement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cpias (id INT AUTO_INCREMENT NOT NULL, date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', note INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE es (id INT AUTO_INCREMENT NOT NULL, date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', note INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etiologie (id INT AUTO_INCREMENT NOT NULL, agent VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE infection (id INT AUTO_INCREMENT NOT NULL, infection VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE organisme (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE resistance (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE signalement (id INT AUTO_INCREMENT NOT NULL, infection_id INT NOT NULL, etiologie_id INT NOT NULL, structure_id INT NOT NULL, numero INT NOT NULL, type VARCHAR(10) NOT NULL, date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', cas INT NOT NULL, commentaire LONGTEXT NOT NULL, epidemie VARCHAR(255) NOT NULL, gravite VARCHAR(255) NOT NULL, population VARCHAR(255) NOT NULL, reco VARCHAR(255) NOT NULL, mesure VARCHAR(255) NOT NULL, capacite VARCHAR(255) NOT NULL, impact VARCHAR(255) NOT NULL, ars VARCHAR(10) DEFAULT NULL, cloture_ars DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', es VARCHAR(10) DEFAULT NULL, cloture_es DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', cpias VARCHAR(10) DEFAULT NULL, cloture_cpias DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', spf VARCHAR(10) DEFAULT NULL, cloture_spf DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_F4B5511436A2EC68 (infection_id), INDEX IDX_F4B55114C56625FC (etiologie_id), INDEX IDX_F4B551142534008B (structure_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE signalement_service (signalement_id INT NOT NULL, service_id INT NOT NULL, INDEX IDX_1F35D22665C5E57E (signalement_id), INDEX IDX_1F35D226ED5CA9E6 (service_id), PRIMARY KEY(signalement_id, service_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE signalement_organisme (signalement_id INT NOT NULL, organisme_id INT NOT NULL, INDEX IDX_D5D8568065C5E57E (signalement_id), INDEX IDX_D5D856805DDD38F5 (organisme_id), PRIMARY KEY(signalement_id, organisme_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE signalement_resistance (signalement_id INT NOT NULL, resistance_id INT NOT NULL, INDEX IDX_5A6CB1C765C5E57E (signalement_id), INDEX IDX_5A6CB1C79A7ED092 (resistance_id), PRIMARY KEY(signalement_id, resistance_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE souche (id INT AUTO_INCREMENT NOT NULL, signalement_id INT NOT NULL, laboratoire VARCHAR(10) NOT NULL, date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', numero INT DEFAULT NULL, INDEX IDX_A19A6FFF65C5E57E (signalement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE spf (id INT AUTO_INCREMENT NOT NULL, date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', note INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE structure (id INT AUTO_INCREMENT NOT NULL, finess_g INT NOT NULL, finess_j INT NOT NULL, nom VARCHAR(50) NOT NULL, numero INT DEFAULT NULL, voie VARCHAR(255) DEFAULT NULL, adresse VARCHAR(50) DEFAULT NULL, cp INT NOT NULL, ville VARCHAR(50) NOT NULL, departement VARCHAR(20) NOT NULL, longitude DOUBLE PRECISION NOT NULL, latitude DOUBLE PRECISION NOT NULL, type VARCHAR(15) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E63865C5E57E FOREIGN KEY (signalement_id) REFERENCES signalement (id)');
        $this->addSql('ALTER TABLE signalement ADD CONSTRAINT FK_F4B5511436A2EC68 FOREIGN KEY (infection_id) REFERENCES infection (id)');
        $this->addSql('ALTER TABLE signalement ADD CONSTRAINT FK_F4B55114C56625FC FOREIGN KEY (etiologie_id) REFERENCES etiologie (id)');
        $this->addSql('ALTER TABLE signalement ADD CONSTRAINT FK_F4B551142534008B FOREIGN KEY (structure_id) REFERENCES structure (id)');
        $this->addSql('ALTER TABLE signalement_service ADD CONSTRAINT FK_1F35D22665C5E57E FOREIGN KEY (signalement_id) REFERENCES signalement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE signalement_service ADD CONSTRAINT FK_1F35D226ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE signalement_organisme ADD CONSTRAINT FK_D5D8568065C5E57E FOREIGN KEY (signalement_id) REFERENCES signalement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE signalement_organisme ADD CONSTRAINT FK_D5D856805DDD38F5 FOREIGN KEY (organisme_id) REFERENCES organisme (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE signalement_resistance ADD CONSTRAINT FK_5A6CB1C765C5E57E FOREIGN KEY (signalement_id) REFERENCES signalement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE signalement_resistance ADD CONSTRAINT FK_5A6CB1C79A7ED092 FOREIGN KEY (resistance_id) REFERENCES resistance (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE souche ADD CONSTRAINT FK_A19A6FFF65C5E57E FOREIGN KEY (signalement_id) REFERENCES signalement (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E63865C5E57E');
        $this->addSql('ALTER TABLE signalement DROP FOREIGN KEY FK_F4B5511436A2EC68');
        $this->addSql('ALTER TABLE signalement DROP FOREIGN KEY FK_F4B55114C56625FC');
        $this->addSql('ALTER TABLE signalement DROP FOREIGN KEY FK_F4B551142534008B');
        $this->addSql('ALTER TABLE signalement_service DROP FOREIGN KEY FK_1F35D22665C5E57E');
        $this->addSql('ALTER TABLE signalement_service DROP FOREIGN KEY FK_1F35D226ED5CA9E6');
        $this->addSql('ALTER TABLE signalement_organisme DROP FOREIGN KEY FK_D5D8568065C5E57E');
        $this->addSql('ALTER TABLE signalement_organisme DROP FOREIGN KEY FK_D5D856805DDD38F5');
        $this->addSql('ALTER TABLE signalement_resistance DROP FOREIGN KEY FK_5A6CB1C765C5E57E');
        $this->addSql('ALTER TABLE signalement_resistance DROP FOREIGN KEY FK_5A6CB1C79A7ED092');
        $this->addSql('ALTER TABLE souche DROP FOREIGN KEY FK_A19A6FFF65C5E57E');
        $this->addSql('DROP TABLE ars');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE cpias');
        $this->addSql('DROP TABLE es');
        $this->addSql('DROP TABLE etiologie');
        $this->addSql('DROP TABLE infection');
        $this->addSql('DROP TABLE organisme');
        $this->addSql('DROP TABLE resistance');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE signalement');
        $this->addSql('DROP TABLE signalement_service');
        $this->addSql('DROP TABLE signalement_organisme');
        $this->addSql('DROP TABLE signalement_resistance');
        $this->addSql('DROP TABLE souche');
        $this->addSql('DROP TABLE spf');
        $this->addSql('DROP TABLE structure');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
