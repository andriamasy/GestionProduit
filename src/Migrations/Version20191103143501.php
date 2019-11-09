<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191103143501 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE produit CHANGE poid_dufruit_acheter poid_dufruit_acheter INT DEFAULT NULL, CHANGE passage_raffiner passage_raffiner INT DEFAULT NULL, CHANGE passage_emissionneuse passage_emissionneuse INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE produit CHANGE poid_dufruit_acheter poid_dufruit_acheter VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE passage_raffiner passage_raffiner VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE passage_emissionneuse passage_emissionneuse VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
    }
}
