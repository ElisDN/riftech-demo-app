<?php declare(strict_types=1);

namespace Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180927155020 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE auction_lots (id UUID NOT NULL, member_id UUID NOT NULL, winner_id UUID DEFAULT NULL, create_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, status VARCHAR(16) NOT NULL, on_moderation_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, publish_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, update_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, reject_reason VARCHAR(255) DEFAULT NULL, close_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, content_name VARCHAR(255) NOT NULL, content_description TEXT NOT NULL, price_start INT NOT NULL, price_blitz INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5A0BDC6D7597D3FE ON auction_lots (member_id)');
        $this->addSql('CREATE INDEX IDX_5A0BDC6D5DFCD4B8 ON auction_lots (winner_id)');
        $this->addSql('COMMENT ON COLUMN auction_lots.create_date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN auction_lots.on_moderation_date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN auction_lots.publish_date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN auction_lots.update_date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN auction_lots.close_date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE auction_lot_bids (id UUID NOT NULL, lot_id UUID NOT NULL, member_id UUID NOT NULL, price INT NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1E54DEB0A8CBA5F7 ON auction_lot_bids (lot_id)');
        $this->addSql('CREATE INDEX IDX_1E54DEB07597D3FE ON auction_lot_bids (member_id)');
        $this->addSql('CREATE UNIQUE INDEX auction_lot_bids_lot_member ON auction_lot_bids (lot_id, member_id)');
        $this->addSql('COMMENT ON COLUMN auction_lot_bids.date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE auction_members (id UUID NOT NULL, email VARCHAR(255) NOT NULL, name_last VARCHAR(255) NOT NULL, name_first VARCHAR(255) NOT NULL, name_middle VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE auction_lots ADD CONSTRAINT FK_5A0BDC6D7597D3FE FOREIGN KEY (member_id) REFERENCES auction_members (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE auction_lots ADD CONSTRAINT FK_5A0BDC6D5DFCD4B8 FOREIGN KEY (winner_id) REFERENCES auction_lot_bids (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE auction_lot_bids ADD CONSTRAINT FK_1E54DEB0A8CBA5F7 FOREIGN KEY (lot_id) REFERENCES auction_lots (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE auction_lot_bids ADD CONSTRAINT FK_1E54DEB07597D3FE FOREIGN KEY (member_id) REFERENCES auction_members (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE auction_lot_bids DROP CONSTRAINT FK_1E54DEB0A8CBA5F7');
        $this->addSql('ALTER TABLE auction_lots DROP CONSTRAINT FK_5A0BDC6D5DFCD4B8');
        $this->addSql('ALTER TABLE auction_lots DROP CONSTRAINT FK_5A0BDC6D7597D3FE');
        $this->addSql('ALTER TABLE auction_lot_bids DROP CONSTRAINT FK_1E54DEB07597D3FE');
        $this->addSql('DROP TABLE auction_lots');
        $this->addSql('DROP TABLE auction_lot_bids');
        $this->addSql('DROP TABLE auction_members');
    }
}
