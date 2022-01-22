<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220119133030 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE clase_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE personaje_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE raza_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE clase (id INT NOT NULL, nombre VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE personaje (id INT NOT NULL, raza_id INT NOT NULL, clase_id INT NOT NULL, nombre VARCHAR(255) NOT NULL, edad INT NOT NULL, historia VARCHAR(8000) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_53A410888CCBB6A9 ON personaje (raza_id)');
        $this->addSql('CREATE INDEX IDX_53A410889F720353 ON personaje (clase_id)');
        $this->addSql('CREATE TABLE raza (id INT NOT NULL, nombre VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE personaje ADD CONSTRAINT FK_53A410888CCBB6A9 FOREIGN KEY (raza_id) REFERENCES raza (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE personaje ADD CONSTRAINT FK_53A410889F720353 FOREIGN KEY (clase_id) REFERENCES clase (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE personaje DROP CONSTRAINT FK_53A410889F720353');
        $this->addSql('ALTER TABLE personaje DROP CONSTRAINT FK_53A410888CCBB6A9');
        $this->addSql('DROP SEQUENCE clase_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE personaje_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE raza_id_seq CASCADE');
        $this->addSql('DROP TABLE clase');
        $this->addSql('DROP TABLE personaje');
        $this->addSql('DROP TABLE raza');
    }
}
