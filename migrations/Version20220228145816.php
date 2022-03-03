<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220228145816 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE genre_movie DROP FOREIGN KEY FK_A058EDAA4296D31F');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP TABLE genre_movie');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE genre (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, id_tmdb INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE genre_movie (genre_id INT NOT NULL, movie_id INT NOT NULL, INDEX IDX_A058EDAA4296D31F (genre_id), INDEX IDX_A058EDAA8F93B6FC (movie_id), PRIMARY KEY(genre_id, movie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE genre_movie ADD CONSTRAINT FK_A058EDAA4296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE genre_movie ADD CONSTRAINT FK_A058EDAA8F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movie CHANGE title title VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE poster_path poster_path VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE imdb_id imdb_id VARCHAR(20) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE original_title original_title VARCHAR(100) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE overview overview LONGTEXT DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
