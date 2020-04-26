<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200426150743 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE alert (id INT AUTO_INCREMENT NOT NULL, message_id INT DEFAULT NULL, user_id INT DEFAULT NULL, INDEX IDX_17FD46C1537A1329 (message_id), INDEX IDX_17FD46C1A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE area (id INT AUTO_INCREMENT NOT NULL, name LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE issue (id INT AUTO_INCREMENT NOT NULL, picture_id INT DEFAULT NULL, code VARCHAR(255) DEFAULT NULL, creation_date DATETIME DEFAULT NULL, adress VARCHAR(255) DEFAULT NULL, INDEX IDX_12AD233EEE45BDBF (picture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE issue_area (issue_id INT NOT NULL, area_id INT NOT NULL, INDEX IDX_8F73F5A45E7AA58C (issue_id), INDEX IDX_8F73F5A4BD0F409C (area_id), PRIMARY KEY(issue_id, area_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE issue_user (issue_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_D5741E855E7AA58C (issue_id), INDEX IDX_D5741E85A76ED395 (user_id), PRIMARY KEY(issue_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE issue_category (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) DEFAULT NULL, moderation_needed TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, author_id INT DEFAULT NULL, issue_id INT DEFAULT NULL, text LONGTEXT DEFAULT NULL, creationdate DATETIME DEFAULT NULL, visibility VARCHAR(255) DEFAULT NULL, INDEX IDX_B6BD307FF675F31B (author_id), INDEX IDX_B6BD307F5E7AA58C (issue_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message_picture (message_id INT NOT NULL, picture_id INT NOT NULL, INDEX IDX_86537585537A1329 (message_id), INDEX IDX_86537585EE45BDBF (picture_id), PRIMARY KEY(message_id, picture_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE moderator_issue (id INT AUTO_INCREMENT NOT NULL, issue_id INT DEFAULT NULL, assignation_date DATETIME DEFAULT NULL, INDEX IDX_A35EAFB65E7AA58C (issue_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE picture (id INT AUTO_INCREMENT NOT NULL, file_name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, role_id INT DEFAULT NULL, username VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, last_connexion DATETIME DEFAULT NULL, newsletter TINYINT(1) DEFAULT NULL, INDEX IDX_8D93D649D60322AC (role_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE alert ADD CONSTRAINT FK_17FD46C1537A1329 FOREIGN KEY (message_id) REFERENCES message (id)');
        $this->addSql('ALTER TABLE alert ADD CONSTRAINT FK_17FD46C1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE issue ADD CONSTRAINT FK_12AD233EEE45BDBF FOREIGN KEY (picture_id) REFERENCES picture (id)');
        $this->addSql('ALTER TABLE issue_area ADD CONSTRAINT FK_8F73F5A45E7AA58C FOREIGN KEY (issue_id) REFERENCES issue (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE issue_area ADD CONSTRAINT FK_8F73F5A4BD0F409C FOREIGN KEY (area_id) REFERENCES area (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE issue_user ADD CONSTRAINT FK_D5741E855E7AA58C FOREIGN KEY (issue_id) REFERENCES issue (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE issue_user ADD CONSTRAINT FK_D5741E85A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FF675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F5E7AA58C FOREIGN KEY (issue_id) REFERENCES issue (id)');
        $this->addSql('ALTER TABLE message_picture ADD CONSTRAINT FK_86537585537A1329 FOREIGN KEY (message_id) REFERENCES message (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE message_picture ADD CONSTRAINT FK_86537585EE45BDBF FOREIGN KEY (picture_id) REFERENCES picture (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE moderator_issue ADD CONSTRAINT FK_A35EAFB65E7AA58C FOREIGN KEY (issue_id) REFERENCES issue (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE issue_area DROP FOREIGN KEY FK_8F73F5A4BD0F409C');
        $this->addSql('ALTER TABLE issue_area DROP FOREIGN KEY FK_8F73F5A45E7AA58C');
        $this->addSql('ALTER TABLE issue_user DROP FOREIGN KEY FK_D5741E855E7AA58C');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F5E7AA58C');
        $this->addSql('ALTER TABLE moderator_issue DROP FOREIGN KEY FK_A35EAFB65E7AA58C');
        $this->addSql('ALTER TABLE alert DROP FOREIGN KEY FK_17FD46C1537A1329');
        $this->addSql('ALTER TABLE message_picture DROP FOREIGN KEY FK_86537585537A1329');
        $this->addSql('ALTER TABLE issue DROP FOREIGN KEY FK_12AD233EEE45BDBF');
        $this->addSql('ALTER TABLE message_picture DROP FOREIGN KEY FK_86537585EE45BDBF');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649D60322AC');
        $this->addSql('ALTER TABLE alert DROP FOREIGN KEY FK_17FD46C1A76ED395');
        $this->addSql('ALTER TABLE issue_user DROP FOREIGN KEY FK_D5741E85A76ED395');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FF675F31B');
        $this->addSql('DROP TABLE alert');
        $this->addSql('DROP TABLE area');
        $this->addSql('DROP TABLE issue');
        $this->addSql('DROP TABLE issue_area');
        $this->addSql('DROP TABLE issue_user');
        $this->addSql('DROP TABLE issue_category');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE message_picture');
        $this->addSql('DROP TABLE moderator_issue');
        $this->addSql('DROP TABLE picture');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP TABLE user');
    }
}
