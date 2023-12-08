<?php

class NivelEducativoModel {
    // Conexión a la BD
    protected $db;

    private $cod_nivel;

    private $desc_nivel;

    public function __construct() {
        //Traemos la única instancia de PDO
        $this->db = SPDO::singleton();
    }

    /**
     * Get the value of cod_nivel
     */
    public function getCodNivel() {
        return $this->cod_nivel;
    }

    /**
     * Set the value of cod_nivel
     */
    public function setCodNivel($cod_nivel): self {
        $this->cod_nivel = $cod_nivel;

        return $this;
    }

    /**
     * Get the value of desc_nivel
     */
    public function getDescNivel() {
        return $this->desc_nivel;
    }

    /**
     * Set the value of desc_nivel
     */
    public function setDescNivel($desc_nivel): self {
        $this->desc_nivel = $desc_nivel;

        return $this;
    }


    public function getAll() {
        $consulta = $this->db->prepare('SELECT * FROM nivel_educativo');
        $consulta->execute();

        $resultado = $consulta->fetchAll(PDO::FETCH_CLASS, "NivelEducativoModel");

        return $resultado;
    }


    public function getById($codigo) {
        $gsent = $this->db->prepare('SELECT * FROM nivel_educativo WHERE cod_nivel = ?');
        $gsent->bindParam(1, $codigo);
        $gsent->execute();

        $gsent->setFetchMode(PDO::FETCH_CLASS, "NivelEducativoModel");
        $resultado = $gsent->fetch();

        return $resultado;
    }

    public function save() {
        if (!isset($this->cod_nivel)) {
            $consulta = $this->db->prepare('INSERT INTO nivel_educativo(desc_nivel) VALUES (?)');
            $consulta->bindParam(1, $this->desc_nivel);
            $consulta->execute();
        } else {
            $consulta = $this->db->prepare('UPDATE nivel_educativo SET desc_nivel=? WHERE cod_nivel=?');
            $consulta->bindParam(1, $this->desc_nivel);
            $consulta->bindParam(2, $this->cod_nivel);
            $consulta->execute();
        }
    }

    public function delete() {
        $consulta = $this->db->prepare('DELETE FROM nivel_educativo WHERE cod_nivel=?');
        $consulta->bindParam(1, $this->cod_nivel);
        $consulta->execute();
    }
}
?>