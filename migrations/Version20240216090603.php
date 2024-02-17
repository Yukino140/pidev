<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240216090603 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE transaction_compte DROP FOREIGN KEY FK_B98B20202FC0CB0F');
        $this->addSql('ALTER TABLE transaction_compte DROP FOREIGN KEY FK_B98B2020F2C56620');
        $this->addSql('DROP TABLE transaction_compte');
        $this->addSql('ALTER TABLE transaction ADD id_compte_id INT NOT NULL');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D172F0DA07 FOREIGN KEY (id_compte_id) REFERENCES compte (id)');
        $this->addSql('CREATE INDEX IDX_723705D172F0DA07 ON transaction (id_compte_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE transaction_compte (transaction_id INT NOT NULL, compte_id INT NOT NULL, INDEX IDX_B98B2020F2C56620 (compte_id), INDEX IDX_B98B20202FC0CB0F (transaction_id), PRIMARY KEY(transaction_id, compte_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE transaction_compte ADD CONSTRAINT FK_B98B20202FC0CB0F FOREIGN KEY (transaction_id) REFERENCES transaction (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE transaction_compte ADD CONSTRAINT FK_B98B2020F2C56620 FOREIGN KEY (compte_id) REFERENCES compte (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D172F0DA07');
        $this->addSql('DROP INDEX IDX_723705D172F0DA07 ON transaction');
        $this->addSql('ALTER TABLE transaction DROP id_compte_id');
    }
}
