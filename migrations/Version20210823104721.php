<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210823104721 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gestion_association ADD types_id INT NOT NULL, ADD slug VARCHAR(255) NOT NULL, ADD created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE gestion_association ADD CONSTRAINT FK_60FF1268EB23357 FOREIGN KEY (types_id) REFERENCES type_association (id)');
        $this->addSql('CREATE INDEX IDX_60FF1268EB23357 ON gestion_association (types_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gestion_association DROP FOREIGN KEY FK_60FF1268EB23357');
        $this->addSql('DROP INDEX IDX_60FF1268EB23357 ON gestion_association');
        $this->addSql('ALTER TABLE gestion_association DROP types_id, DROP slug, DROP created_at');
    }
}
