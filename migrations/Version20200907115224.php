<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200907115224 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE function_user (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, function_user_id INT NOT NULL, pseudo VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D64986CC499D (pseudo), INDEX IDX_8D93D64949535D54 (function_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE function_user_role (function_user_id INT NOT NULL, role_id INT NOT NULL, INDEX IDX_F50960B649535D54 (function_user_id), INDEX IDX_F50960B6D60322AC (role_id), PRIMARY KEY(function_user_id, role_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64949535D54 FOREIGN KEY (function_user_id) REFERENCES function_user (id)');
        $this->addSql('ALTER TABLE function_user_role ADD CONSTRAINT FK_F50960B649535D54 FOREIGN KEY (function_user_id) REFERENCES function_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE function_user_role ADD CONSTRAINT FK_F50960B6D60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE function_user_role DROP FOREIGN KEY FK_F50960B649535D54');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64949535D54');
        $this->addSql('ALTER TABLE function_user_role DROP FOREIGN KEY FK_F50960B6D60322AC');
        $this->addSql('DROP TABLE function_user');
        $this->addSql('DROP TABLE function_user_role');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE user');
    }
}
