<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250521094203 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE agent (id INT AUTO_INCREMENT NOT NULL, organisme_id INT DEFAULT NULL, INDEX IDX_268B9C9D5DDD38F5 (organisme_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE agent_resistance (agent_id INT NOT NULL, resistance_id INT NOT NULL, INDEX IDX_794A55ED3414710B (agent_id), INDEX IDX_794A55ED9A7ED092 (resistance_id), PRIMARY KEY(agent_id, resistance_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE signalement_agent (signalement_id INT NOT NULL, agent_id INT NOT NULL, INDEX IDX_A9E6B35365C5E57E (signalement_id), INDEX IDX_A9E6B3533414710B (agent_id), PRIMARY KEY(signalement_id, agent_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE agent ADD CONSTRAINT FK_268B9C9D5DDD38F5 FOREIGN KEY (organisme_id) REFERENCES organisme (id)');
        $this->addSql('ALTER TABLE agent_resistance ADD CONSTRAINT FK_794A55ED3414710B FOREIGN KEY (agent_id) REFERENCES agent (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE agent_resistance ADD CONSTRAINT FK_794A55ED9A7ED092 FOREIGN KEY (resistance_id) REFERENCES resistance (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE signalement_agent ADD CONSTRAINT FK_A9E6B35365C5E57E FOREIGN KEY (signalement_id) REFERENCES signalement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE signalement_agent ADD CONSTRAINT FK_A9E6B3533414710B FOREIGN KEY (agent_id) REFERENCES agent (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE signalement_organisme DROP FOREIGN KEY FK_D5D8568065C5E57E');
        $this->addSql('ALTER TABLE signalement_organisme DROP FOREIGN KEY FK_D5D856805DDD38F5');
        $this->addSql('ALTER TABLE signalement_resistance DROP FOREIGN KEY FK_5A6CB1C765C5E57E');
        $this->addSql('ALTER TABLE signalement_resistance DROP FOREIGN KEY FK_5A6CB1C79A7ED092');
        $this->addSql('DROP TABLE signalement_organisme');
        $this->addSql('DROP TABLE signalement_resistance');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE signalement_organisme (signalement_id INT NOT NULL, organisme_id INT NOT NULL, INDEX IDX_D5D856805DDD38F5 (organisme_id), INDEX IDX_D5D8568065C5E57E (signalement_id), PRIMARY KEY(signalement_id, organisme_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE signalement_resistance (signalement_id INT NOT NULL, resistance_id INT NOT NULL, INDEX IDX_5A6CB1C79A7ED092 (resistance_id), INDEX IDX_5A6CB1C765C5E57E (signalement_id), PRIMARY KEY(signalement_id, resistance_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE signalement_organisme ADD CONSTRAINT FK_D5D8568065C5E57E FOREIGN KEY (signalement_id) REFERENCES signalement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE signalement_organisme ADD CONSTRAINT FK_D5D856805DDD38F5 FOREIGN KEY (organisme_id) REFERENCES organisme (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE signalement_resistance ADD CONSTRAINT FK_5A6CB1C765C5E57E FOREIGN KEY (signalement_id) REFERENCES signalement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE signalement_resistance ADD CONSTRAINT FK_5A6CB1C79A7ED092 FOREIGN KEY (resistance_id) REFERENCES resistance (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE agent DROP FOREIGN KEY FK_268B9C9D5DDD38F5');
        $this->addSql('ALTER TABLE agent_resistance DROP FOREIGN KEY FK_794A55ED3414710B');
        $this->addSql('ALTER TABLE agent_resistance DROP FOREIGN KEY FK_794A55ED9A7ED092');
        $this->addSql('ALTER TABLE signalement_agent DROP FOREIGN KEY FK_A9E6B35365C5E57E');
        $this->addSql('ALTER TABLE signalement_agent DROP FOREIGN KEY FK_A9E6B3533414710B');
        $this->addSql('DROP TABLE agent');
        $this->addSql('DROP TABLE agent_resistance');
        $this->addSql('DROP TABLE signalement_agent');
    }
}
