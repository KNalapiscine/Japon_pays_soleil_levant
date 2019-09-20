<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190909144428 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE sous_menus (id INT AUTO_INCREMENT NOT NULL, menu_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, INDEX IDX_D91082ACCD7E912 (menu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sous_menus ADD CONSTRAINT FK_D91082ACCD7E912 FOREIGN KEY (menu_id) REFERENCES menus (id)');
        $this->addSql('ALTER TABLE articles DROP nom');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE sous_menus');
        $this->addSql('ALTER TABLE articles ADD nom LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
