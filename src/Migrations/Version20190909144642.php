<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190909144642 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE articles ADD sous_menu_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD3168EFDE915F FOREIGN KEY (sous_menu_id) REFERENCES sous_menus (id)');
        $this->addSql('CREATE INDEX IDX_BFDD3168EFDE915F ON articles (sous_menu_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD3168EFDE915F');
        $this->addSql('DROP INDEX IDX_BFDD3168EFDE915F ON articles');
        $this->addSql('ALTER TABLE articles DROP sous_menu_id');
    }
}
