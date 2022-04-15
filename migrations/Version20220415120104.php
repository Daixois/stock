<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220415120104 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE collections_user (collections_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_E720DB4C242C7AD2 (collections_id), INDEX IDX_E720DB4CA76ED395 (user_id), PRIMARY KEY(collections_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE collections_user ADD CONSTRAINT FK_E720DB4C242C7AD2 FOREIGN KEY (collections_id) REFERENCES collections (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE collections_user ADD CONSTRAINT FK_E720DB4CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE collections_user');
        $this->addSql('ALTER TABLE collections CHANGE type type VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE picture picture VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE image image VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE genre CHANGE name name VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE movie CHANGE title title VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE poster_path poster_path VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE imdb_id imdb_id VARCHAR(20) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE original_title original_title VARCHAR(100) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE overview overview LONGTEXT DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(180) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE pseudo pseudo VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE image image VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
