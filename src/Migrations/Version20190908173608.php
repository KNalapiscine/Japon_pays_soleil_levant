<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190908173608 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE photos ADD articles_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE photos ADD CONSTRAINT FK_876E0D91EBAF6CC FOREIGN KEY (articles_id) REFERENCES photos (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_876E0D91EBAF6CC ON photos (articles_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE photos DROP FOREIGN KEY FK_876E0D91EBAF6CC');
        $this->addSql('DROP INDEX UNIQ_876E0D91EBAF6CC ON photos');
        $this->addSql('ALTER TABLE photos DROP articles_id');
    }
}
