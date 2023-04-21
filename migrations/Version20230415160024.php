<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230415160024 extends AbstractMigration
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
        $this->addSql('CREATE TABLE person_hobbies (person_id INT NOT NULL, hobbies_id INT NOT NULL, INDEX IDX_1A548794217BBB47 (person_id), INDEX IDX_1A548794B2242D72 (hobbies_id), PRIMARY KEY(person_id, hobbies_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profile (id INT AUTO_INCREMENT NOT NULL, rs VARCHAR(70) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE person_hobbies ADD CONSTRAINT FK_1A548794217BBB47 FOREIGN KEY (person_id) REFERENCES person (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE person_hobbies ADD CONSTRAINT FK_1A548794B2242D72 FOREIGN KEY (hobbies_id) REFERENCES hobbies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE person ADD profile_id INT DEFAULT NULL, ADD job_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD176CCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id)');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD176BE04EA9 FOREIGN KEY (job_id) REFERENCES job (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_34DCD176CCFA12B8 ON person (profile_id)');
        $this->addSql('CREATE INDEX IDX_34DCD176BE04EA9 ON person (job_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE person DROP FOREIGN KEY FK_34DCD176BE04EA9');
        $this->addSql('ALTER TABLE person DROP FOREIGN KEY FK_34DCD176CCFA12B8');
        $this->addSql('ALTER TABLE person_hobbies DROP FOREIGN KEY FK_1A548794217BBB47');
        $this->addSql('ALTER TABLE person_hobbies DROP FOREIGN KEY FK_1A548794B2242D72');
        $this->addSql('DROP TABLE hobbies');
        $this->addSql('DROP TABLE job');
        $this->addSql('DROP TABLE person_hobbies');
        $this->addSql('DROP TABLE profile');
        $this->addSql('DROP INDEX UNIQ_34DCD176CCFA12B8 ON person');
        $this->addSql('DROP INDEX IDX_34DCD176BE04EA9 ON person');
        $this->addSql('ALTER TABLE person DROP profile_id, DROP job_id');
    }
}
