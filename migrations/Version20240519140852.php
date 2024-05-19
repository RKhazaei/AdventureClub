<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240519140852 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lesson ADD member_id INT DEFAULT NULL, ADD docent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE lesson ADD CONSTRAINT FK_F87474F37597D3FE FOREIGN KEY (member_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE lesson ADD CONSTRAINT FK_F87474F357755C45 FOREIGN KEY (docent_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_F87474F37597D3FE ON lesson (member_id)');
        $this->addSql('CREATE INDEX IDX_F87474F357755C45 ON lesson (docent_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lesson DROP FOREIGN KEY FK_F87474F37597D3FE');
        $this->addSql('ALTER TABLE lesson DROP FOREIGN KEY FK_F87474F357755C45');
        $this->addSql('DROP INDEX IDX_F87474F37597D3FE ON lesson');
        $this->addSql('DROP INDEX IDX_F87474F357755C45 ON lesson');
        $this->addSql('ALTER TABLE lesson DROP member_id, DROP docent_id');
    }
}
