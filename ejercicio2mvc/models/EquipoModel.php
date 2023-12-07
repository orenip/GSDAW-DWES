<?php

class EquipoModel {
    // Conexión a la BD
    protected $db;

    private $curso_equipo;

    private $profesor_equipo;

    private $materia_equipo;

    public function __construct() {
        //Traemos la única instancia de PDO
        $this->db = SPDO::singleton();
    }

     /**
     * Get the value of materia_equipo
     */
    public function getMateriaEquipo()
    {
        return $this->materia_equipo;
    }

    /**
     * Set the value of materia_equipo
     */
    public function setMateriaEquipo($materia_equipo): self
    {
        $this->materia_equipo = $materia_equipo;

        return $this;
    }

    /**
     * Get the value of profesor_equipo
     */
    public function getProfesorEquipo()
    {
        return $this->profesor_equipo;
    }

    /**
     * Set the value of profesor_equipo
     */
    public function setProfesorEquipo($profesor_equipo): self
    {
        $this->profesor_equipo = $profesor_equipo;

        return $this;
    }

    /**
     * Get the value of curso_equipo
     */
    public function getCursoEquipo()
    {
        return $this->curso_equipo;
    }

    /**
     * Set the value of curso_equipo
     */
    public function setCursoEquipo($curso_equipo): self
    {
        $this->curso_equipo = $curso_equipo;

        return $this;
    }
    
    public function getAll() {
        $consulta = $this->db->prepare('SELECT * FROM equipo_docente');
        $consulta->execute();

        $resultado = $consulta->fetchAll(PDO::FETCH_CLASS, "EquipoModel");

        return $resultado;
    }


    public function getById($codigo) {
        $gsent = $this->db->prepare('SELECT * FROM equipo_docente WHERE curso_equipo = ?');
        $gsent->bindParam(1, $codigo);
        $gsent->execute();

        $gsent->setFetchMode(PDO::FETCH_CLASS, "EquipoModel");
        $resultado = $gsent->fetch();

        return $resultado;
    }

    public function save() {
        if (!isset($this->curso_equipo)) {
            $consulta = $this->db->prepare('INSERT INTO equipo_docente(curso_equipo,profesor_equipo,materia_equipo) VALUES (?,?,?)');
            $consulta->bindParam(1, $this->curso_equipo,PDO::PARAM_INT);
            $consulta->bindParam(2, $this->profesor_equipo,PDO::PARAM_INT);
            $consulta->bindParam(3, $this->materia_equipo,PDO::PARAM_STR);
            $consulta->execute();
        } else {
            $consulta = $this->db->prepare('UPDATE equipo_docente SET profesor_equipo=?, materia_equipo=? WHERE curso_equipo=?');
            $consulta->bindParam(1, $this->profesor_equipo,PDO::PARAM_INT);
            $consulta->bindParam(2, $this->materia_equipo,PDO::PARAM_STR);
            $consulta->bindParam(3, $this->curso_equipo,PDO::PARAM_INT);
            $consulta->execute();
        }
    }

    public function delete() {
        $consulta = $this->db->prepare('DELETE FROM equipo_docente WHERE curso_equipo=?');
        $consulta->bindParam(1, $this->curso_equipo);
        $consulta->execute();
    }


    // Método para obtener la descripción del nivel educativo de un curso

    public function getDescProfesor(): string {
        if (isset($this->profesor_equipo)) {
            $gsent = $this->db->prepare('SELECT nombre_profesor FROM profesor WHERE cod_profesor= ?');
            $gsent->bindParam(1, $this->profesor_equipo);
            $gsent->execute();
            $resultado = $gsent->fetch();

            return $resultado[0];
        } else {
            return null;
        }
    }

   
}
?>