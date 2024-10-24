<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230413053140 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY fk_id_event');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3D52B4B97 FOREIGN KEY (id_event) REFERENCES evenement (idEvent)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA3D52B4B97');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT fk_id_event FOREIGN KEY (id_event) REFERENCES evenement (idEvent) ON UPDATE CASCADE ON DELETE CASCADE');
    }
}
