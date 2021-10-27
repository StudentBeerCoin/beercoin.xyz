<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211027102150 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE beer (id VARCHAR(36) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE history (id VARCHAR(36) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE offer (id VARCHAR(36) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "user" (id VARCHAR(36) NOT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE beer');
        $this->addSql('DROP TABLE history');
        $this->addSql('DROP TABLE offer');
        $this->addSql('DROP TABLE "user"');
    }
}
