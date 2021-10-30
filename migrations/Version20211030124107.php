<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211030124107 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE history ADD offer_id VARCHAR(36) NOT NULL');
        $this->addSql('ALTER TABLE history ADD counterparty_id VARCHAR(36) NOT NULL');
        $this->addSql('ALTER TABLE history ADD amount INT NOT NULL');
        $this->addSql('ALTER TABLE history ADD CONSTRAINT FK_27BA704B53C674EE FOREIGN KEY (offer_id) REFERENCES offer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE history ADD CONSTRAINT FK_27BA704BDB1FAD05 FOREIGN KEY (counterparty_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_27BA704B53C674EE ON history (offer_id)');
        $this->addSql('CREATE INDEX IDX_27BA704BDB1FAD05 ON history (counterparty_id)');
        $this->addSql('ALTER TABLE offer ADD owner_id VARCHAR(36) NOT NULL');
        $this->addSql('ALTER TABLE offer ADD beer_id VARCHAR(36) NOT NULL');
        $this->addSql('ALTER TABLE offer ADD amount INT NOT NULL');
        $this->addSql('ALTER TABLE offer ADD price DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE offer ADD location_x DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE offer ADD location_y DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE offer ADD type_of_transaction BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873E7E3C61F9 FOREIGN KEY (owner_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873ED0989053 FOREIGN KEY (beer_id) REFERENCES beer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_29D6873E7E3C61F9 ON offer (owner_id)');
        $this->addSql('CREATE INDEX IDX_29D6873ED0989053 ON offer (beer_id)');
        $this->addSql('ALTER TABLE "user" ADD username VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD surname VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD email VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD phone_number VARCHAR(9) NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD balance DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD location_x DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD location_y DOUBLE PRECISION NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE history DROP CONSTRAINT FK_27BA704B53C674EE');
        $this->addSql('ALTER TABLE history DROP CONSTRAINT FK_27BA704BDB1FAD05');
        $this->addSql('DROP INDEX IDX_27BA704B53C674EE');
        $this->addSql('DROP INDEX IDX_27BA704BDB1FAD05');
        $this->addSql('ALTER TABLE history DROP offer_id');
        $this->addSql('ALTER TABLE history DROP counterparty_id');
        $this->addSql('ALTER TABLE history DROP amount');
        $this->addSql('ALTER TABLE offer DROP CONSTRAINT FK_29D6873E7E3C61F9');
        $this->addSql('ALTER TABLE offer DROP CONSTRAINT FK_29D6873ED0989053');
        $this->addSql('DROP INDEX IDX_29D6873E7E3C61F9');
        $this->addSql('DROP INDEX IDX_29D6873ED0989053');
        $this->addSql('ALTER TABLE offer DROP owner_id');
        $this->addSql('ALTER TABLE offer DROP beer_id');
        $this->addSql('ALTER TABLE offer DROP amount');
        $this->addSql('ALTER TABLE offer DROP price');
        $this->addSql('ALTER TABLE offer DROP location_x');
        $this->addSql('ALTER TABLE offer DROP location_y');
        $this->addSql('ALTER TABLE offer DROP type_of_transaction');
        $this->addSql('ALTER TABLE "user" DROP username');
        $this->addSql('ALTER TABLE "user" DROP name');
        $this->addSql('ALTER TABLE "user" DROP surname');
        $this->addSql('ALTER TABLE "user" DROP email');
        $this->addSql('ALTER TABLE "user" DROP phone_number');
        $this->addSql('ALTER TABLE "user" DROP balance');
        $this->addSql('ALTER TABLE "user" DROP location_x');
        $this->addSql('ALTER TABLE "user" DROP location_y');
    }
}
