<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240516092016 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE story ADD member_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE story ADD CONSTRAINT FK_EB5604387597D3FE FOREIGN KEY (member_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_EB5604387597D3FE ON story (member_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE story DROP FOREIGN KEY FK_EB5604387597D3FE');
        $this->addSql('DROP INDEX IDX_EB5604387597D3FE ON story');
        $this->addSql('ALTER TABLE story DROP member_id');
    }
}
