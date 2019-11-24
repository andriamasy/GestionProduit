<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191124131926 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE fiche_de_vente (id INT AUTO_INCREMENT NOT NULL, type_produit_id INT DEFAULT NULL, date DATETIME NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, nbr_produit_achete INT NOT NULL, lot VARCHAR(255) DEFAULT NULL, prix_unitaire DOUBLE PRECISION NOT NULL, montant DOUBLE PRECISION NOT NULL, adresse VARCHAR(255) DEFAULT NULL, contact INT NOT NULL, INDEX IDX_3D634F881237A8DE (type_produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fiche_de_vente ADD CONSTRAINT FK_3D634F881237A8DE FOREIGN KEY (type_produit_id) REFERENCES category (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE fiche_de_vente');
    }
}
