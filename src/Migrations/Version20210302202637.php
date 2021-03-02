<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210302202637 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE issue DROP FOREIGN KEY FK_12AD233E61220EA6');
        $this->addSql('DROP INDEX IDX_12AD233E61220EA6 ON issue');
        $this->addSql('ALTER TABLE issue ADD creator_email VARCHAR(255) NOT NULL, DROP creator_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE issue ADD creator_id INT DEFAULT NULL, DROP creator_email');
        $this->addSql('ALTER TABLE issue ADD CONSTRAINT FK_12AD233E61220EA6 FOREIGN KEY (creator_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_12AD233E61220EA6 ON issue (creator_id)');
    }
}
