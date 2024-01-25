<?php

class CursoModel {
    // Conexión a la BD
    protected $db;

    private $cod_curso;

    private $desc_curso;

    private $nivel_curso;

    public function __construct() {
        //Traemos la única instancia de PDO
        $this->db = SPDO::singleton();
    }

    /**
     * Get the value of cod_curso
     */
    public function getCodCurso()
    {
        return $this->cod_curso;
    }

    /**
     * Set the value of cod_curso
     */
    public function setCodCurso($cod_curso): self
    {
        $this->cod_curso = $cod_curso;

        return $this;
    }

    /**
     * Get the value of desc_curso
     */
    public function getDescCurso()
    {
        return $this->desc_curso;
    }

    /**
     * Set the value of desc_curso
     */
    public function setDescCurso($desc_curso): self
    {
        $this->desc_curso = $desc_curso;

        return $this;
    }

    
    /**
     * Get the value of nivel_curso
     */
    public function getNivelCurso()
    {
        return $this->nivel_curso;
    }

    /**
     * Set the value of nivel_curso
     */
    public function setNivelCurso($nivel_curso): self
    {
        $this->nivel_curso = $nivel_curso;

        return $this;
    }
    
    public function getAll() {
        $consulta = $this->db->prepare('SELECT * FROM curso');
        $consulta->execute();

        $resultado = $consulta->fetchAll(PDO::FETCH_CLASS, "CursoModel");

        return $resultado;
    }


    public function getById($codigo) {
        $gsent = $this->db->prepare('SELECT * FROM curso WHERE cod_curso = ?');
        $gsent->bindParam(1, $codigo);
        $gsent->execute();

        $gsent->setFetchMode(PDO::FETCH_CLASS, "CursoModel");
        $resultado = $gsent->fetch();

        return $resultado;
    }

    public function save() {
        if (!isset($this->cod_curso)) {
            $consulta = $this->db->prepare('INSERT INTO curso(desc_curso,nivel_curso) VALUES (?,?)');
            $consulta->bindParam(1, $this->desc_curso,PDO::PARAM_STR);
            $consulta->bindParam(2, $this->nivel_curso,PDO::PARAM_INT);
            $consulta->execute();
        } else {
            $consulta = $this->db->prepare('UPDATE curso SET desc_curso=?, nivel_curso=? WHERE cod_curso=?');
            $consulta->bindParam(1, $this->desc_curso,PDO::PARAM_STR);
            $consulta->bindParam(2, $this->nivel_curso,PDO::PARAM_INT);
            $consulta->bindParam(3, $this->cod_curso,PDO::PARAM_INT);
            $consulta->execute();
        }
    }

    public function delete() {
        $consulta = $this->db->prepare('DELETE FROM curso WHERE cod_curso=?');
        $consulta->bindParam(1, $this->cod_curso);
        $consulta->execute();
    }


    // Método para obtener la descripción del nivel educativo de un curso
    public function getDescNivel(): string {
        if (isset($this->nivel_curso)) {
            $gsent = $this->db->prepare('SELECT desc_nivel FROM nivel_educativo WHERE cod_nivel = ?');
            $gsent->bindParam(1, $this->nivel_curso);
            $gsent->execute();
            $resultado = $gsent->fetch();

            return $resultado[0];
        } else {
            return null;
        }
    }
}
?>