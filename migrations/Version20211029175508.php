<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211029175508 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE beer ADD brand VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE beer ADD name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE beer ADD volume INT NOT NULL');
        $this->addSql('ALTER TABLE beer ADD alcohol DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE beer ADD packing BOOLEAN NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE beer DROP brand');
        $this->addSql('ALTER TABLE beer DROP name');
        $this->addSql('ALTER TABLE beer DROP volume');
        $this->addSql('ALTER TABLE beer DROP alcohol');
        $this->addSql('ALTER TABLE beer DROP packing');
    }
}
