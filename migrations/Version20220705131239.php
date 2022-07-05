<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220705131239 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE agent (id INT AUTO_INCREMENT NOT NULL, mission_id INT DEFAULT NULL, lastname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, date_of_birth DATE NOT NULL, identification_code INT NOT NULL, nationality VARCHAR(255) NOT NULL, INDEX IDX_268B9C9DBE6CAE90 (mission_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE agent_specialite (agent_id INT NOT NULL, specialite_id INT NOT NULL, INDEX IDX_96902DCE3414710B (agent_id), INDEX IDX_96902DCE2195E0F0 (specialite_id), PRIMARY KEY(agent_id, specialite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cible (id INT AUTO_INCREMENT NOT NULL, mission_id INT DEFAULT NULL, lastname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, date_of_birth DATE NOT NULL, nationality VARCHAR(255) NOT NULL, code_name VARCHAR(255) NOT NULL, INDEX IDX_E15DEC3BBE6CAE90 (mission_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, mission_id INT DEFAULT NULL, lastname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, date_of_birth DATE NOT NULL, nationality VARCHAR(255) NOT NULL, code_name VARCHAR(255) NOT NULL, INDEX IDX_4C62E638BE6CAE90 (mission_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mission (id INT AUTO_INCREMENT NOT NULL, speciality_id INT DEFAULT NULL, status_id INT DEFAULT NULL, type_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, code_name VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, INDEX IDX_9067F23C3B5A08D7 (speciality_id), INDEX IDX_9067F23C6BF700BD (status_id), INDEX IDX_9067F23CC54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE planque (id INT AUTO_INCREMENT NOT NULL, mission_id INT DEFAULT NULL, code INT NOT NULL, address LONGTEXT NOT NULL, country VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_4B3A04BABE6CAE90 (mission_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE specialite (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_mission (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE agent ADD CONSTRAINT FK_268B9C9DBE6CAE90 FOREIGN KEY (mission_id) REFERENCES mission (id)');
        $this->addSql('ALTER TABLE agent_specialite ADD CONSTRAINT FK_96902DCE3414710B FOREIGN KEY (agent_id) REFERENCES agent (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE agent_specialite ADD CONSTRAINT FK_96902DCE2195E0F0 FOREIGN KEY (specialite_id) REFERENCES specialite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cible ADD CONSTRAINT FK_E15DEC3BBE6CAE90 FOREIGN KEY (mission_id) REFERENCES mission (id)');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638BE6CAE90 FOREIGN KEY (mission_id) REFERENCES mission (id)');
        $this->addSql('ALTER TABLE mission ADD CONSTRAINT FK_9067F23C3B5A08D7 FOREIGN KEY (speciality_id) REFERENCES specialite (id)');
        $this->addSql('ALTER TABLE mission ADD CONSTRAINT FK_9067F23C6BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        $this->addSql('ALTER TABLE mission ADD CONSTRAINT FK_9067F23CC54C8C93 FOREIGN KEY (type_id) REFERENCES type_mission (id)');
        $this->addSql('ALTER TABLE planque ADD CONSTRAINT FK_4B3A04BABE6CAE90 FOREIGN KEY (mission_id) REFERENCES mission (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agent_specialite DROP FOREIGN KEY FK_96902DCE3414710B');
        $this->addSql('ALTER TABLE agent DROP FOREIGN KEY FK_268B9C9DBE6CAE90');
        $this->addSql('ALTER TABLE cible DROP FOREIGN KEY FK_E15DEC3BBE6CAE90');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638BE6CAE90');
        $this->addSql('ALTER TABLE planque DROP FOREIGN KEY FK_4B3A04BABE6CAE90');
        $this->addSql('ALTER TABLE agent_specialite DROP FOREIGN KEY FK_96902DCE2195E0F0');
        $this->addSql('ALTER TABLE mission DROP FOREIGN KEY FK_9067F23C3B5A08D7');
        $this->addSql('ALTER TABLE mission DROP FOREIGN KEY FK_9067F23C6BF700BD');
        $this->addSql('ALTER TABLE mission DROP FOREIGN KEY FK_9067F23CC54C8C93');
        $this->addSql('DROP TABLE agent');
        $this->addSql('DROP TABLE agent_specialite');
        $this->addSql('DROP TABLE cible');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE mission');
        $this->addSql('DROP TABLE planque');
        $this->addSql('DROP TABLE specialite');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP TABLE type_mission');
    }
}
