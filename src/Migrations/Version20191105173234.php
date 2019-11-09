<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191105173234 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE produit CHANGE poid_dufruit_acheter poid_dufruit_acheter DOUBLE PRECISION DEFAULT NULL, CHANGE poid_dufruitepluches poid_dufruitepluches DOUBLE PRECISION DEFAULT NULL, CHANGE passage_raffiner passage_raffiner DOUBLE PRECISION DEFAULT NULL, CHANGE nombre_tamissage nombre_tamissage DOUBLE PRECISION DEFAULT NULL, CHANGE poid_du_fruit_tamisse poid_du_fruit_tamisse DOUBLE PRECISION DEFAULT NULL, CHANGE passage_emissionneuse passage_emissionneuse DOUBLE PRECISION DEFAULT NULL, CHANGE qte_eau qte_eau DOUBLE PRECISION DEFAULT NULL, CHANGE poid_final poid_final DOUBLE PRECISION DEFAULT NULL, CHANGE mesurr_phavant mesurr_phavant DOUBLE PRECISION DEFAULT NULL, CHANGE qte_acide qte_acide DOUBLE PRECISION DEFAULT NULL, CHANGE mesure_phapres mesure_phapres DOUBLE PRECISION DEFAULT NULL, CHANGE mesure_brix mesure_brix DOUBLE PRECISION DEFAULT NULL, CHANGE qte_sucre qte_sucre DOUBLE PRECISION DEFAULT NULL, CHANGE mesure_brix_final mesure_brix_final DOUBLE PRECISION DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE produit CHANGE poid_dufruit_acheter poid_dufruit_acheter INT DEFAULT NULL, CHANGE poid_dufruitepluches poid_dufruitepluches INT DEFAULT NULL, CHANGE passage_raffiner passage_raffiner INT DEFAULT NULL, CHANGE nombre_tamissage nombre_tamissage INT DEFAULT NULL, CHANGE poid_du_fruit_tamisse poid_du_fruit_tamisse INT DEFAULT NULL, CHANGE passage_emissionneuse passage_emissionneuse INT DEFAULT NULL, CHANGE qte_eau qte_eau INT DEFAULT NULL, CHANGE poid_final poid_final INT DEFAULT NULL, CHANGE mesurr_phavant mesurr_phavant INT DEFAULT NULL, CHANGE qte_acide qte_acide INT DEFAULT NULL, CHANGE mesure_phapres mesure_phapres INT DEFAULT NULL, CHANGE mesure_brix mesure_brix INT DEFAULT NULL, CHANGE qte_sucre qte_sucre INT DEFAULT NULL, CHANGE mesure_brix_final mesure_brix_final INT DEFAULT NULL');
    }
}
