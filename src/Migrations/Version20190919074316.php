<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190919074316 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE articles ADD photos_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD3168301EC62 FOREIGN KEY (photos_id) REFERENCES photos (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BFDD3168301EC62 ON articles (photos_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD3168301EC62');
        $this->addSql('DROP INDEX UNIQ_BFDD3168301EC62 ON articles');
        $this->addSql('ALTER TABLE articles DROP photos_id');
    }
}
