<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230306221021 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cv ADD color_second VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE cv ADD bg_color VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE cv RENAME COLUMN color TO color_first');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE cv ADD color VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE cv DROP color_first');
        $this->addSql('ALTER TABLE cv DROP color_second');
        $this->addSql('ALTER TABLE cv DROP bg_color');
    }
}
