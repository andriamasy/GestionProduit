<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200103131212 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE livraison_client DROP destination, DROP designation');
        $this->addSql('ALTER TABLE livraisonfournisseur DROP destination, DROP designation');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE livraison_client ADD destination VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD designation VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE livraisonfournisseur ADD destination VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD designation VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
