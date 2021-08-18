<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210817120308 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE association (id INT AUTO_INCREMENT NOT NULL, denomination VARCHAR(255) NOT NULL, adresse_siege VARCHAR(255) NOT NULL, date_de_signature DATE DEFAULT NULL, region LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', deartement VARCHAR(255) DEFAULT NULL, geolocalisation LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', type LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', grande_rubrique LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', machine VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE association');
    }
}
