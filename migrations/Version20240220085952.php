<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240220085952 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('UPDATE post set nb_likes = 0 where nb_likes IS NULL');
        $this->addSql('UPDATE post set created_at = 0 where created_at IS NULL');
        $this->addSql('ALTER TABLE post CHANGE body body LONGTEXT NOT NULL, CHANGE nb_likes nb_likes INT NOT NULL, CHANGE created_at created_at DATETIME NOT NULL');

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE post CHANGE body body VARCHAR(255) NOT NULL, CHANGE nb_likes nb_likes SMALLINT DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('UPDATE post set nb_likes = null where nb_likes 0');
        $this->addSql('UPDATE post set created_at = null where created_at 0');
    }
}
