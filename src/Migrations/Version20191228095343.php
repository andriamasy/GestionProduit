<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191228095343 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE command_produit DROP FOREIGN KEY FK_C6CFBFC4966BE84D');
        $this->addSql('ALTER TABLE command_produit DROP FOREIGN KEY FK_C6CFBFC4AABEFE2C');
        $this->addSql('DROP INDEX IDX_C6CFBFC4AABEFE2C ON command_produit');
        $this->addSql('DROP INDEX IDX_C6CFBFC4966BE84D ON command_produit');
        $this->addSql('ALTER TABLE command_produit ADD command_id INT NOT NULL, ADD produit_id INT NOT NULL, ADD qte INT NOT NULL, DROP id_command_id, DROP id_produit_id');
        $this->addSql('ALTER TABLE command_produit ADD CONSTRAINT FK_C6CFBFC433E1689A FOREIGN KEY (command_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE command_produit ADD CONSTRAINT FK_C6CFBFC4F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('CREATE INDEX IDX_C6CFBFC433E1689A ON command_produit (command_id)');
        $this->addSql('CREATE INDEX IDX_C6CFBFC4F347EFB ON command_produit (produit_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE command_produit DROP FOREIGN KEY FK_C6CFBFC433E1689A');
        $this->addSql('ALTER TABLE command_produit DROP FOREIGN KEY FK_C6CFBFC4F347EFB');
        $this->addSql('DROP INDEX IDX_C6CFBFC433E1689A ON command_produit');
        $this->addSql('DROP INDEX IDX_C6CFBFC4F347EFB ON command_produit');
        $this->addSql('ALTER TABLE command_produit ADD id_command_id INT NOT NULL, ADD id_produit_id INT NOT NULL, DROP command_id, DROP produit_id, DROP qte');
        $this->addSql('ALTER TABLE command_produit ADD CONSTRAINT FK_C6CFBFC4966BE84D FOREIGN KEY (id_command_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE command_produit ADD CONSTRAINT FK_C6CFBFC4AABEFE2C FOREIGN KEY (id_produit_id) REFERENCES produit (id)');
        $this->addSql('CREATE INDEX IDX_C6CFBFC4AABEFE2C ON command_produit (id_produit_id)');
        $this->addSql('CREATE INDEX IDX_C6CFBFC4966BE84D ON command_produit (id_command_id)');
    }
}
