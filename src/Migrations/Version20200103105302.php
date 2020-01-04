<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200103105302 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE livraison_client');
        $this->addSql('DROP TABLE livraisonfournisseur');
        $this->addSql('ALTER TABLE livraison ADD commande_id INT DEFAULT NULL, ADD fournisseur_id INT DEFAULT NULL, ADD dtype VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1F82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1F670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('CREATE INDEX IDX_A60C9F1F82EA2E54 ON livraison (commande_id)');
        $this->addSql('CREATE INDEX IDX_A60C9F1F670C757F ON livraison (fournisseur_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE livraison_client (id INT AUTO_INCREMENT NOT NULL, commande_id INT DEFAULT NULL, date_livraison DATETIME NOT NULL, destination VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, transporteur VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, designation VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, reference VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_EE2100BF82EA2E54 (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE livraisonfournisseur (id INT AUTO_INCREMENT NOT NULL, fournisseur_id INT DEFAULT NULL, date_livraison DATETIME NOT NULL, destination VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, transporteur VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, designation VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, reference VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_B1263444670C757F (fournisseur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE livraison_client ADD CONSTRAINT FK_EE2100BF82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE livraisonfournisseur ADD CONSTRAINT FK_B1263444670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1F82EA2E54');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1F670C757F');
        $this->addSql('DROP INDEX IDX_A60C9F1F82EA2E54 ON livraison');
        $this->addSql('DROP INDEX IDX_A60C9F1F670C757F ON livraison');
        $this->addSql('ALTER TABLE livraison DROP commande_id, DROP fournisseur_id, DROP dtype');
    }
}
