<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240220154104 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE post DROP image, CHANGE body body LONGTEXT NOT NULL, CHANGE nb_likes nb_likes INT UNSIGNED NOT NULL, CHANGE published_at published_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE created_at created_at DATETIME NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE post ADD image VARCHAR(255) DEFAULT NULL, CHANGE body body LONGTEXT DEFAULT NULL, CHANGE nb_likes nb_likes INT DEFAULT NULL, CHANGE published_at published_at DATETIME DEFAULT NULL, CHANGE created_at created_at DATE DEFAULT NULL, CHANGE updated_at updated_at DATE DEFAULT NULL');
    }
}
