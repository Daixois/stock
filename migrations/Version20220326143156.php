<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220326143156 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE collections ADD type VARCHAR(255) DEFAULT NULL, DROP films, DROP livres, DROP musique, DROP jeuxvideos, DROP presse, DROP comics, DROP bd');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE collections ADD films VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD livres VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD musique VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD jeuxvideos VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD presse VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD comics VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD bd VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, DROP type');
        $this->addSql('ALTER TABLE genre CHANGE name name VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE movie CHANGE title title VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE poster_path poster_path VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE imdb_id imdb_id VARCHAR(20) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE original_title original_title VARCHAR(100) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE overview overview LONGTEXT DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(180) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE pseudo pseudo VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
