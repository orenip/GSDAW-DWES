<?php

class EquipoDocenteModel {
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
     * Get the value of curso_equipo
     */
    public function getCursoEquipo() {
        return $this->curso_equipo;
    }


    /**
     * Set the value of curso_equipo
     */
    public function setCursoEquipo($curso_equipo): self {
        $this->curso_equipo = $curso_equipo;

        return $this;
    }

    /**
     * Get the value of profesor_equipo
     */
    public function getProfesorEquipo() {
        return $this->profesor_equipo;
    }

    /**
     * Set the value of profesor_equipo
     */
    public function setProfesorEquipo($profesor_equipo): self {
        $this->profesor_equipo = $profesor_equipo;

        return $this;
    }

    /**
     * Get the value of materia_equipo
     */
    public function getMateriaEquipo() {
        return $this->materia_equipo;
    }

    /**
     * Set the value of materia_equipo
     */
    public function setMateriaEquipo($materia_equipo): self {
        $this->materia_equipo = $materia_equipo;

        return $this;
    }


    public function getByCurso(int $curso) {
        $consulta = $this->db->prepare('SELECT * FROM equipo_docente WHERE curso_equipo = ?');
        $consulta->bindParam(1, $curso, PDO::PARAM_INT);
        $consulta->execute();

        $resultado = $consulta->fetchAll(PDO::FETCH_CLASS, "EquipoDocenteModel");

        return $resultado;
    }


    public function getById($curso, $profesor) {
        $gsent = $this->db->prepare('SELECT * FROM equipo_docente WHERE curso_equipo = ? AND profesor_equipo = ?');
        $gsent->bindParam(1, $curso);
        $gsent->bindParam(2, $profesor);
        $gsent->execute();

        $gsent->setFetchMode(PDO::FETCH_CLASS, "EquipoDocenteModel");
        $resultado = $gsent->fetch();

        return $resultado;
    }

    /**
     * Esta función se utiliza para insertar en la base de datos un objeto de tipo EquipoDocente.
     * A diferencia de otros modelos, aquí se han creado varios métodos en lugar de un único método
     * "save()".
     * @return void
     */
    public function insert() {
        // El código del curso siempre debe estar, si no está no se hace nada
        if (isset($this->curso_equipo) and isset($this->profesor_equipo)) {
            $consulta = $this->db->prepare('INSERT INTO equipo_docente(curso_equipo, profesor_equipo, materia_equipo) VALUES (?,?,?)');
            $consulta->bindParam(1, $this->curso_equipo, PDO::PARAM_INT);
            $consulta->bindParam(2, $this->profesor_equipo, PDO::PARAM_INT);
            $consulta->bindParam(3, $this->materia_equipo, PDO::PARAM_STR);
            $consulta->execute();
        }
    }

    /**
     * Este método actualiza un registro de la tabla "equipo_docente". Como el objeto del modelo
     * ya tiene un código de profesor, se le pasa el código del nuevo profesor al método para poder
     * hacer bien el update en la base de datos.
     * @param mixed $nuevo_profe
     * @return void
     */
    public function update($nuevo_profe) {
        // El código del curso siempre debe estar, si no está no se hace nada
        if (isset($this->curso_equipo) and isset($this->profesor_equipo)) {
            $consulta = $this->db->prepare('UPDATE equipo_docente SET profesor_equipo=?, materia_equipo=? WHERE curso_equipo=? and profesor_equipo=?');
            $consulta->bindParam(1, $nuevo_profe, PDO::PARAM_INT);
            $consulta->bindParam(2, $this->materia_equipo, PDO::PARAM_STR);
            $consulta->bindParam(3, $this->curso_equipo, PDO::PARAM_INT);
            $consulta->bindParam(4, $this->profesor_equipo, PDO::PARAM_INT);
            $consulta->execute();
        }
    }

    /**
     * Método para eliminar de la base de datos un registro de equipo_docente. Se utilizan los dos atributos
     * de la clave primaria para seleccionar el registro a eliminar.
     * @return void
     */
    public function delete() {
        $consulta = $this->db->prepare('DELETE FROM equipo_docente WHERE curso_equipo=? and profesor_equipo=?');
        $consulta->bindParam(1, $this->curso_equipo, PDO::PARAM_INT);
        $consulta->bindParam(2, $this->profesor_equipo, PDO::PARAM_INT);
        $consulta->execute();
    }


    // Método para obtener la descripción de un curso
    public function getDescCurso(): string {
        if (isset($this->curso_equipo)) {
            $gsent = $this->db->prepare('SELECT desc_curso FROM curso WHERE cod_curso = ?');
            $gsent->bindParam(1, $this->curso_equipo, PDO::PARAM_INT);
            $gsent->execute();
            $resultado = $gsent->fetch();

            return $resultado[0];
        } else {
            return null;
        }
    }


    // Método para obtener el nombre de un profesor
    public function getNombreProfesor(): string {
        if (isset($this->profesor_equipo)) {
            $gsent = $this->db->prepare('SELECT nombre_profesor FROM profesor WHERE cod_profesor = ?');
            $gsent->bindParam(1, $this->profesor_equipo, PDO::PARAM_INT);
            $gsent->execute();
            $resultado = $gsent->fetch();

            return $resultado[0];
        } else {
            return null;
        }
    }
}
?>