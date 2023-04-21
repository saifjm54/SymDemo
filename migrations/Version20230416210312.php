<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230416210312 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE hobbies (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(700) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(60) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE person (id INT AUTO_INCREMENT NOT NULL, profile_id INT DEFAULT NULL, job_id INT DEFAULT NULL, firstname VARCHAR(50) DEFAULT NULL, name VARCHAR(50) NOT NULL, age SMALLINT DEFAULT NULL, UNIQUE INDEX UNIQ_34DCD176CCFA12B8 (profile_id), INDEX IDX_34DCD176BE04EA9 (job_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE person_hobbies (person_id INT NOT NULL, hobbies_id INT NOT NULL, INDEX IDX_1A548794217BBB47 (person_id), INDEX IDX_1A548794B2242D72 (hobbies_id), PRIMARY KEY(person_id, hobbies_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profile (id INT AUTO_INCREMENT NOT NULL, rs VARCHAR(70) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD176CCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id)');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD176BE04EA9 FOREIGN KEY (job_id) REFERENCES job (id)');
        $this->addSql('ALTER TABLE person_hobbies ADD CONSTRAINT FK_1A548794217BBB47 FOREIGN KEY (person_id) REFERENCES person (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE person_hobbies ADD CONSTRAINT FK_1A548794B2242D72 FOREIGN KEY (hobbies_id) REFERENCES hobbies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE praticien DROP FOREIGN KEY FK_D9A27D36BF700BD');
        $this->addSql('ALTER TABLE praticien DROP FOREIGN KEY FK_D9A27D3CCFA12B8');
        $this->addSql('ALTER TABLE praticien_speciality DROP FOREIGN KEY FK_6F1E1B942391866B');
        $this->addSql('ALTER TABLE praticien_speciality DROP FOREIGN KEY FK_6F1E1B943B5A08D7');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE praticien');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE praticien_speciality');
        $this->addSql('DROP TABLE speciality');
        $this->addSql('DROP TABLE status');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, zipcode VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, street VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, city VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, country VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE praticien (id INT AUTO_INCREMENT NOT NULL, profile_id INT NOT NULL, status_id INT NOT NULL, phone VARCHAR(12) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_D9A27D3CCFA12B8 (profile_id), INDEX IDX_D9A27D36BF700BD (status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, roles JSON NOT NULL, password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, username VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, firstname VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, lastname VARCHAR(70) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, is_active TINYINT(1) NOT NULL, date_joined DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE praticien_speciality (praticien_id INT NOT NULL, speciality_id INT NOT NULL, INDEX IDX_6F1E1B943B5A08D7 (speciality_id), INDEX IDX_6F1E1B942391866B (praticien_id), PRIMARY KEY(praticien_id, speciality_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE speciality (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, status VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE praticien ADD CONSTRAINT FK_D9A27D36BF700BD FOREIGN KEY (status_id) REFERENCES status (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE praticien ADD CONSTRAINT FK_D9A27D3CCFA12B8 FOREIGN KEY (profile_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE praticien_speciality ADD CONSTRAINT FK_6F1E1B942391866B FOREIGN KEY (praticien_id) REFERENCES praticien (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE praticien_speciality ADD CONSTRAINT FK_6F1E1B943B5A08D7 FOREIGN KEY (speciality_id) REFERENCES speciality (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE person DROP FOREIGN KEY FK_34DCD176CCFA12B8');
        $this->addSql('ALTER TABLE person DROP FOREIGN KEY FK_34DCD176BE04EA9');
        $this->addSql('ALTER TABLE person_hobbies DROP FOREIGN KEY FK_1A548794217BBB47');
        $this->addSql('ALTER TABLE person_hobbies DROP FOREIGN KEY FK_1A548794B2242D72');
        $this->addSql('DROP TABLE hobbies');
        $this->addSql('DROP TABLE job');
        $this->addSql('DROP TABLE person');
        $this->addSql('DROP TABLE person_hobbies');
        $this->addSql('DROP TABLE profile');
    }
}
