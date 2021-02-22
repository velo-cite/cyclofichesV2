<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210222222102 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE alert (id INT AUTO_INCREMENT NOT NULL, message_id INT DEFAULT NULL, user_id INT DEFAULT NULL, INDEX IDX_17FD46C1537A1329 (message_id), INDEX IDX_17FD46C1A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE area (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE issue (id INT AUTO_INCREMENT NOT NULL, area_id INT DEFAULT NULL, status_id INT DEFAULT NULL, creator_id INT DEFAULT NULL, category_id INT DEFAULT NULL, code VARCHAR(255) DEFAULT NULL, creation_date DATETIME DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, gps_coordinates VARCHAR(255) DEFAULT NULL, INDEX IDX_12AD233EBD0F409C (area_id), INDEX IDX_12AD233E6BF700BD (status_id), INDEX IDX_12AD233E61220EA6 (creator_id), INDEX IDX_12AD233E12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE issue_picture (issue_id INT NOT NULL, picture_id INT NOT NULL, INDEX IDX_B3230A685E7AA58C (issue_id), INDEX IDX_B3230A68EE45BDBF (picture_id), PRIMARY KEY(issue_id, picture_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE issue_user (issue_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_D5741E855E7AA58C (issue_id), INDEX IDX_D5741E85A76ED395 (user_id), PRIMARY KEY(issue_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE issue_category (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) DEFAULT NULL, moderation_needed TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, author_id INT DEFAULT NULL, issue_id INT DEFAULT NULL, visibility_id INT DEFAULT NULL, text LONGTEXT DEFAULT NULL, creation_date DATETIME DEFAULT NULL, INDEX IDX_B6BD307FF675F31B (author_id), INDEX IDX_B6BD307F5E7AA58C (issue_id), INDEX IDX_B6BD307FB7157780 (visibility_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message_picture (message_id INT NOT NULL, picture_id INT NOT NULL, INDEX IDX_86537585537A1329 (message_id), INDEX IDX_86537585EE45BDBF (picture_id), PRIMARY KEY(message_id, picture_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE moderator_issue (id INT AUTO_INCREMENT NOT NULL, issue_id INT DEFAULT NULL, moderator_id INT DEFAULT NULL, assignation_date DATETIME DEFAULT NULL, INDEX IDX_A35EAFB65E7AA58C (issue_id), INDEX IDX_A35EAFB6D0AFA354 (moderator_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE picture (id INT AUTO_INCREMENT NOT NULL, file_name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `right` (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, name VARCHAR(32) DEFAULT NULL, INDEX IDX_B4CA751412469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE right_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(32) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(32) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role_visibility (role_id INT NOT NULL, visibility_id INT NOT NULL, INDEX IDX_DEBA292CD60322AC (role_id), INDEX IDX_DEBA292CB7157780 (visibility_id), PRIMARY KEY(role_id, visibility_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role_right (role_id INT NOT NULL, right_id INT NOT NULL, INDEX IDX_43169D3BD60322AC (role_id), INDEX IDX_43169D3B54976835 (right_id), PRIMARY KEY(role_id, right_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(32) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, role_id INT DEFAULT NULL, email VARCHAR(128) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, last_connexion DATETIME DEFAULT NULL, newsletter TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D649D60322AC (role_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE visibility (id INT AUTO_INCREMENT NOT NULL, label INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE alert ADD CONSTRAINT FK_17FD46C1537A1329 FOREIGN KEY (message_id) REFERENCES message (id)');
        $this->addSql('ALTER TABLE alert ADD CONSTRAINT FK_17FD46C1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE issue ADD CONSTRAINT FK_12AD233EBD0F409C FOREIGN KEY (area_id) REFERENCES area (id)');
        $this->addSql('ALTER TABLE issue ADD CONSTRAINT FK_12AD233E6BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        $this->addSql('ALTER TABLE issue ADD CONSTRAINT FK_12AD233E61220EA6 FOREIGN KEY (creator_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE issue ADD CONSTRAINT FK_12AD233E12469DE2 FOREIGN KEY (category_id) REFERENCES issue_category (id)');
        $this->addSql('ALTER TABLE issue_picture ADD CONSTRAINT FK_B3230A685E7AA58C FOREIGN KEY (issue_id) REFERENCES issue (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE issue_picture ADD CONSTRAINT FK_B3230A68EE45BDBF FOREIGN KEY (picture_id) REFERENCES picture (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE issue_user ADD CONSTRAINT FK_D5741E855E7AA58C FOREIGN KEY (issue_id) REFERENCES issue (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE issue_user ADD CONSTRAINT FK_D5741E85A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FF675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F5E7AA58C FOREIGN KEY (issue_id) REFERENCES issue (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FB7157780 FOREIGN KEY (visibility_id) REFERENCES visibility (id)');
        $this->addSql('ALTER TABLE message_picture ADD CONSTRAINT FK_86537585537A1329 FOREIGN KEY (message_id) REFERENCES message (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE message_picture ADD CONSTRAINT FK_86537585EE45BDBF FOREIGN KEY (picture_id) REFERENCES picture (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE moderator_issue ADD CONSTRAINT FK_A35EAFB65E7AA58C FOREIGN KEY (issue_id) REFERENCES issue (id)');
        $this->addSql('ALTER TABLE moderator_issue ADD CONSTRAINT FK_A35EAFB6D0AFA354 FOREIGN KEY (moderator_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE `right` ADD CONSTRAINT FK_B4CA751412469DE2 FOREIGN KEY (category_id) REFERENCES right_category (id)');
        $this->addSql('ALTER TABLE role_visibility ADD CONSTRAINT FK_DEBA292CD60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE role_visibility ADD CONSTRAINT FK_DEBA292CB7157780 FOREIGN KEY (visibility_id) REFERENCES visibility (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE role_right ADD CONSTRAINT FK_43169D3BD60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE role_right ADD CONSTRAINT FK_43169D3B54976835 FOREIGN KEY (right_id) REFERENCES `right` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE issue DROP FOREIGN KEY FK_12AD233EBD0F409C');
        $this->addSql('ALTER TABLE issue_picture DROP FOREIGN KEY FK_B3230A685E7AA58C');
        $this->addSql('ALTER TABLE issue_user DROP FOREIGN KEY FK_D5741E855E7AA58C');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F5E7AA58C');
        $this->addSql('ALTER TABLE moderator_issue DROP FOREIGN KEY FK_A35EAFB65E7AA58C');
        $this->addSql('ALTER TABLE issue DROP FOREIGN KEY FK_12AD233E12469DE2');
        $this->addSql('ALTER TABLE alert DROP FOREIGN KEY FK_17FD46C1537A1329');
        $this->addSql('ALTER TABLE message_picture DROP FOREIGN KEY FK_86537585537A1329');
        $this->addSql('ALTER TABLE issue_picture DROP FOREIGN KEY FK_B3230A68EE45BDBF');
        $this->addSql('ALTER TABLE message_picture DROP FOREIGN KEY FK_86537585EE45BDBF');
        $this->addSql('ALTER TABLE role_right DROP FOREIGN KEY FK_43169D3B54976835');
        $this->addSql('ALTER TABLE `right` DROP FOREIGN KEY FK_B4CA751412469DE2');
        $this->addSql('ALTER TABLE role_visibility DROP FOREIGN KEY FK_DEBA292CD60322AC');
        $this->addSql('ALTER TABLE role_right DROP FOREIGN KEY FK_43169D3BD60322AC');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649D60322AC');
        $this->addSql('ALTER TABLE issue DROP FOREIGN KEY FK_12AD233E6BF700BD');
        $this->addSql('ALTER TABLE alert DROP FOREIGN KEY FK_17FD46C1A76ED395');
        $this->addSql('ALTER TABLE issue DROP FOREIGN KEY FK_12AD233E61220EA6');
        $this->addSql('ALTER TABLE issue_user DROP FOREIGN KEY FK_D5741E85A76ED395');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FF675F31B');
        $this->addSql('ALTER TABLE moderator_issue DROP FOREIGN KEY FK_A35EAFB6D0AFA354');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FB7157780');
        $this->addSql('ALTER TABLE role_visibility DROP FOREIGN KEY FK_DEBA292CB7157780');
        $this->addSql('DROP TABLE alert');
        $this->addSql('DROP TABLE area');
        $this->addSql('DROP TABLE issue');
        $this->addSql('DROP TABLE issue_picture');
        $this->addSql('DROP TABLE issue_user');
        $this->addSql('DROP TABLE issue_category');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE message_picture');
        $this->addSql('DROP TABLE moderator_issue');
        $this->addSql('DROP TABLE picture');
        $this->addSql('DROP TABLE `right`');
        $this->addSql('DROP TABLE right_category');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE role_visibility');
        $this->addSql('DROP TABLE role_right');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE visibility');
    }
}
