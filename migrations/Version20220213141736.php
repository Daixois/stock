<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220213141736 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE format ADD movie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE format ADD CONSTRAINT FK_DEBA72DF8F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id)');
        $this->addSql('CREATE INDEX IDX_DEBA72DF8F93B6FC ON format (movie_id)');
        $this->addSql('ALTER TABLE movie ADD format VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE format DROP FOREIGN KEY FK_DEBA72DF8F93B6FC');
        $this->addSql('DROP INDEX IDX_DEBA72DF8F93B6FC ON format');
        $this->addSql('ALTER TABLE format DROP movie_id, CHANGE sort sort VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE movie DROP format, CHANGE title title VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE movies CHANGE title title VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
