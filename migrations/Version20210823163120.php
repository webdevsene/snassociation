<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210823163120 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE UNIQUE INDEX UNIQ_60FF126989D9B62 ON gestion_association (slug)');
        $this->addSql('CREATE FULLTEXT INDEX IDX_60FF12615AEA10CB6BD78EE846C5C1 ON gestion_association (denomination, numero_recipice, adresse_siege)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_60FF126989D9B62 ON gestion_association');
        $this->addSql('DROP INDEX IDX_60FF12615AEA10CB6BD78EE846C5C1 ON gestion_association');
    }
}
