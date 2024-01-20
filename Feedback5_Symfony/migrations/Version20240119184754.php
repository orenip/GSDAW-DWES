<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240119184754 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE equipos (id INT AUTO_INCREMENT NOT NULL, zona_id INT NOT NULL, nombre_equipo VARCHAR(40) NOT NULL, presupuesto INT NOT NULL, fecha_fundacion DATE NOT NULL, titulos INT NOT NULL, INDEX IDX_8C188AD0104EA8FC (zona_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE jugadores (id INT AUTO_INCREMENT NOT NULL, equipo_id INT NOT NULL, nombre_jugador VARCHAR(40) NOT NULL, fecha_nacimiento DATE NOT NULL, estatura INT NOT NULL, posicion VARCHAR(12) NOT NULL, INDEX IDX_CF491B7623BFBED (equipo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partidos (id INT AUTO_INCREMENT NOT NULL, cod_equipo1_id INT NOT NULL, cod_equipo2_id INT NOT NULL, fecha DATE NOT NULL, puntos_equipo1 INT NOT NULL, puntos_equipo2 INT NOT NULL, INDEX IDX_8C926FF623C94210 (cod_equipo1_id), INDEX IDX_8C926FF6317CEDFE (cod_equipo2_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE zonas (id INT AUTO_INCREMENT NOT NULL, nombre_zona VARCHAR(24) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE equipos ADD CONSTRAINT FK_8C188AD0104EA8FC FOREIGN KEY (zona_id) REFERENCES zonas (id)');
        $this->addSql('ALTER TABLE jugadores ADD CONSTRAINT FK_CF491B7623BFBED FOREIGN KEY (equipo_id) REFERENCES equipos (id)');
        $this->addSql('ALTER TABLE partidos ADD CONSTRAINT FK_8C926FF623C94210 FOREIGN KEY (cod_equipo1_id) REFERENCES equipos (id)');
        $this->addSql('ALTER TABLE partidos ADD CONSTRAINT FK_8C926FF6317CEDFE FOREIGN KEY (cod_equipo2_id) REFERENCES equipos (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipos DROP FOREIGN KEY FK_8C188AD0104EA8FC');
        $this->addSql('ALTER TABLE jugadores DROP FOREIGN KEY FK_CF491B7623BFBED');
        $this->addSql('ALTER TABLE partidos DROP FOREIGN KEY FK_8C926FF623C94210');
        $this->addSql('ALTER TABLE partidos DROP FOREIGN KEY FK_8C926FF6317CEDFE');
        $this->addSql('DROP TABLE equipos');
        $this->addSql('DROP TABLE jugadores');
        $this->addSql('DROP TABLE partidos');
        $this->addSql('DROP TABLE zonas');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
