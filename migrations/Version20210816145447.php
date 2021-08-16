<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210816145447 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE gestion_association (id INT AUTO_INCREMENT NOT NULL, regions_id INT NOT NULL, departements_id INT NOT NULL, numero_recipice VARCHAR(255) NOT NULL, denomination VARCHAR(255) NOT NULL, adresse_siege VARCHAR(255) NOT NULL, geolocalisation VARCHAR(255) DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, grande_rubrique VARCHAR(255) DEFAULT NULL, INDEX IDX_60FF126FCE83E5F (regions_id), INDEX IDX_60FF1261DB279A6 (departements_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE gestion_association ADD CONSTRAINT FK_60FF126FCE83E5F FOREIGN KEY (regions_id) REFERENCES region_senegal (id)');
        $this->addSql('ALTER TABLE gestion_association ADD CONSTRAINT FK_60FF1261DB279A6 FOREIGN KEY (departements_id) REFERENCES departement (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE gestion_association');
    }
}
