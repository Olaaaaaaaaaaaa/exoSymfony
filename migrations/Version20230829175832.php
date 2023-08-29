<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230829175832 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE hobby (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE human (id INT AUTO_INCREMENT NOT NULL, birth_at DATETIME NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, genre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE human_hobby (human_id INT NOT NULL, hobby_id INT NOT NULL, INDEX IDX_F98AC72B8ABD4580 (human_id), INDEX IDX_F98AC72B322B2123 (hobby_id), PRIMARY KEY(human_id, hobby_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE human_hobby ADD CONSTRAINT FK_F98AC72B8ABD4580 FOREIGN KEY (human_id) REFERENCES human (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE human_hobby ADD CONSTRAINT FK_F98AC72B322B2123 FOREIGN KEY (hobby_id) REFERENCES hobby (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE human_hobby DROP FOREIGN KEY FK_F98AC72B8ABD4580');
        $this->addSql('ALTER TABLE human_hobby DROP FOREIGN KEY FK_F98AC72B322B2123');
        $this->addSql('DROP TABLE hobby');
        $this->addSql('DROP TABLE human');
        $this->addSql('DROP TABLE human_hobby');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
