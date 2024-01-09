<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240109194840 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // Cambios en la tabla equipos
        $this->addSql('ALTER TABLE equipos CHANGE COD_EQUIPO COD_EQUIPO INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE equipos CHANGE ZONA ZONA INT DEFAULT NULL');

        // Cambios en la tabla jugadores
        $this->addSql('ALTER TABLE jugadores CHANGE COD_JUGADOR COD_JUGADOR INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE jugadores CHANGE EQUIPO EQUIPO INT DEFAULT NULL');

        // Cambios en la tabla partidos
        $this->addSql('ALTER TABLE partidos CHANGE COD_PARTIDO COD_PARTIDO INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE partidos CHANGE COD_EQUIPO1 COD_EQUIPO1 INT DEFAULT NULL');
        $this->addSql('ALTER TABLE partidos CHANGE COD_EQUIPO2 COD_EQUIPO2 INT DEFAULT NULL');

        // Cambios en la tabla zonas
        $this->addSql('ALTER TABLE zonas CHANGE COD_ZONA COD_ZONA INT AUTO_INCREMENT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // Cambios en la tabla equipos
        $this->addSql('ALTER TABLE equipos CHANGE COD_EQUIPO COD_EQUIPO INT NOT NULL');
        $this->addSql('ALTER TABLE equipos CHANGE ZONA ZONA INT NOT NULL');

        // Cambios en la tabla jugadores
        $this->addSql('ALTER TABLE jugadores CHANGE COD_JUGADOR COD_JUGADOR INT NOT NULL');
        $this->addSql('ALTER TABLE jugadores CHANGE EQUIPO EQUIPO INT NOT NULL');

        // Cambios en la tabla partidos
        $this->addSql('ALTER TABLE partidos CHANGE COD_PARTIDO COD_PARTIDO INT NOT NULL');
        $this->addSql('ALTER TABLE partidos CHANGE COD_EQUIPO1 COD_EQUIPO1 INT NOT NULL');
        $this->addSql('ALTER TABLE partidos CHANGE COD_EQUIPO2 COD_EQUIPO2 INT NOT NULL');

        // Cambios en la tabla zonas
        $this->addSql('ALTER TABLE zonas CHANGE COD_ZONA COD_ZONA INT NOT NULL');
    }
}
