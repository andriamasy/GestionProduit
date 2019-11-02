<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191102153739 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE produit ADD created_at DATETIME NOT NULL, ADD poid_dufruit_acheter VARCHAR(255) DEFAULT NULL, ADD poid_dufruitepluches INT DEFAULT NULL, ADD passage_raffiner VARCHAR(255) DEFAULT NULL, ADD nombre_tamissage INT DEFAULT NULL, ADD poid_du_fruit_tamisse INT DEFAULT NULL, ADD passage_emissionneuse VARCHAR(255) DEFAULT NULL, ADD qte_eau INT DEFAULT NULL, ADD poid_final INT DEFAULT NULL, ADD mesurr_phavant INT DEFAULT NULL, ADD qte_acide INT DEFAULT NULL, ADD mesure_phapres INT DEFAULT NULL, ADD mesure_brix INT DEFAULT NULL, ADD qte_sucre INT DEFAULT NULL, ADD mesure_brix_final INT DEFAULT NULL, ADD nbr_boite_produite INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE produit DROP created_at, DROP poid_dufruit_acheter, DROP poid_dufruitepluches, DROP passage_raffiner, DROP nombre_tamissage, DROP poid_du_fruit_tamisse, DROP passage_emissionneuse, DROP qte_eau, DROP poid_final, DROP mesurr_phavant, DROP qte_acide, DROP mesure_phapres, DROP mesure_brix, DROP qte_sucre, DROP mesure_brix_final, DROP nbr_boite_produite');
    }
}
