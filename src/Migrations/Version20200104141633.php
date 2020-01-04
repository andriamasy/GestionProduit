<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200104141633 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bar_code ADD produit_id INT NOT NULL, ADD code VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE bar_code ADD CONSTRAINT FK_70D524AAF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('CREATE INDEX IDX_70D524AAF347EFB ON bar_code (produit_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bar_code DROP FOREIGN KEY FK_70D524AAF347EFB');
        $this->addSql('DROP INDEX IDX_70D524AAF347EFB ON bar_code');
        $this->addSql('ALTER TABLE bar_code DROP produit_id, DROP code');
    }
}
