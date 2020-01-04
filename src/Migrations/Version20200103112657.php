<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200103112657 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE livraison');
        $this->addSql('ALTER TABLE livraison_client DROP date_livraison, DROP destination, DROP transporteur, DROP designation, DROP reference');
        $this->addSql('ALTER TABLE livraisonfournisseur DROP date_livraison, DROP destination, DROP transporteur, DROP designation, DROP reference');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE livraison (id INT AUTO_INCREMENT NOT NULL, date_livraison DATETIME NOT NULL, destination VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, transporteur VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, designation VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, reference VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE livraison_client ADD date_livraison DATETIME NOT NULL, ADD destination VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD transporteur VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD designation VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD reference VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE livraisonfournisseur ADD date_livraison DATETIME NOT NULL, ADD destination VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD transporteur VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD designation VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD reference VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
