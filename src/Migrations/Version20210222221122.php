<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210222221122 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE issue_area');
        $this->addSql('DROP TABLE migration_versions');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE issue_area (issue_id INT NOT NULL, area_id INT NOT NULL, INDEX IDX_8F73F5A45E7AA58C (issue_id), INDEX IDX_8F73F5A4BD0F409C (area_id), PRIMARY KEY(issue_id, area_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE migration_versions (version VARCHAR(14) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, executed_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(version)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE issue_area ADD CONSTRAINT FK_8F73F5A45E7AA58C FOREIGN KEY (issue_id) REFERENCES issue (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE issue_area ADD CONSTRAINT FK_8F73F5A4BD0F409C FOREIGN KEY (area_id) REFERENCES area (id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }
}
