<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220228130017 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categ (id INT AUTO_INCREMENT NOT NULL, categorie VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nom (id INT AUTO_INCREMENT NOT NULL, categ_id INT NOT NULL, prix DOUBLE PRECISION NOT NULL, quantite INT NOT NULL, origine VARCHAR(255) DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, INDEX IDX_6C6E55B5E8175B12 (categ_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE nom ADD CONSTRAINT FK_6C6E55B5E8175B12 FOREIGN KEY (categ_id) REFERENCES categ (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE nom DROP FOREIGN KEY FK_6C6E55B5E8175B12');
        $this->addSql('DROP TABLE categ');
        $this->addSql('DROP TABLE nom');
    }
}
