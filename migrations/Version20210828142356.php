<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210828142356 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE association (id INT AUTO_INCREMENT NOT NULL, numero_recepisse INT NOT NULL, denomination VARCHAR(255) NOT NULL, adresse_siege VARCHAR(255) NOT NULL, date_de_signature DATE DEFAULT NULL, region VARCHAR(255) DEFAULT NULL, departement VARCHAR(255) DEFAULT NULL, geolocalisation VARCHAR(255) DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, grande_rubrique VARCHAR(255) DEFAULT NULL, machine VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE departement (id INT AUTO_INCREMENT NOT NULL, id_region INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_C1765B632955449B (id_region), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gestion_association (id INT AUTO_INCREMENT NOT NULL, regions_id INT NOT NULL, departements_id INT NOT NULL, types_id INT NOT NULL, numero_recipice VARCHAR(255) NOT NULL, denomination VARCHAR(255) NOT NULL, adresse_siege VARCHAR(255) NOT NULL, geolocalisation LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', grande_rubrique LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', date_signature DATE NOT NULL, slug VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_60FF126989D9B62 (slug), INDEX IDX_60FF126FCE83E5F (regions_id), INDEX IDX_60FF1261DB279A6 (departements_id), INDEX IDX_60FF1268EB23357 (types_id), FULLTEXT INDEX IDX_60FF12615AEA10CB6BD78EE846C5C1 (denomination, numero_recipice, adresse_siege), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE region_senegal (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, nomreg VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_association (id INT AUTO_INCREMENT NOT NULL, cote VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE departement ADD CONSTRAINT FK_C1765B632955449B FOREIGN KEY (id_region) REFERENCES region_senegal (id)');
        $this->addSql('ALTER TABLE gestion_association ADD CONSTRAINT FK_60FF126FCE83E5F FOREIGN KEY (regions_id) REFERENCES region_senegal (id)');
        $this->addSql('ALTER TABLE gestion_association ADD CONSTRAINT FK_60FF1261DB279A6 FOREIGN KEY (departements_id) REFERENCES departement (id)');
        $this->addSql('ALTER TABLE gestion_association ADD CONSTRAINT FK_60FF1268EB23357 FOREIGN KEY (types_id) REFERENCES type_association (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gestion_association DROP FOREIGN KEY FK_60FF1261DB279A6');
        $this->addSql('ALTER TABLE departement DROP FOREIGN KEY FK_C1765B632955449B');
        $this->addSql('ALTER TABLE gestion_association DROP FOREIGN KEY FK_60FF126FCE83E5F');
        $this->addSql('ALTER TABLE gestion_association DROP FOREIGN KEY FK_60FF1268EB23357');
        $this->addSql('DROP TABLE association');
        $this->addSql('DROP TABLE departement');
        $this->addSql('DROP TABLE gestion_association');
        $this->addSql('DROP TABLE region_senegal');
        $this->addSql('DROP TABLE type_association');
        $this->addSql('DROP TABLE user');
    }
}
