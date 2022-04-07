<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220407110057 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animaux ADD client_id INT NOT NULL');
        $this->addSql('ALTER TABLE animaux ADD CONSTRAINT FK_9ABE194D19EB6921 FOREIGN KEY (client_id) REFERENCES clients (id)');
        $this->addSql('CREATE INDEX IDX_9ABE194D19EB6921 ON animaux (client_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animaux DROP FOREIGN KEY FK_9ABE194D19EB6921');
        $this->addSql('DROP INDEX IDX_9ABE194D19EB6921 ON animaux');
        $this->addSql('ALTER TABLE animaux DROP client_id');
    }
}
