<?php

// Clase del modelo para trabajar con objetos Item que se almacenan en BD en la tabla ITEMS
class EquiposModel
{
    // Conexión a la BD
    protected $db;

    // Atributos del objeto item que coinciden con los campos de la tabla ITEMS

    private $COD_EQUIPO;
    private $NOMBRE_EQUIPO;
    private $PRESUPUESTO;
    private $FECHA_FUNDACION;
    private $ZONA;
    private $TITULOS;



    // Constructor que utiliza el patrón Singleton para tener una única instancia de la conexión a BD
    public function __construct()
    {
        //Traemos la única instancia de PDO
        $this->db = SPDO::singleton();
    }

    // Getters y Setters
    /**
     * Get the value of COD_EQUIPO
     */
    public function getCOD_EQUIPO()
    {
        return $this->COD_EQUIPO;
    }

    /**
     * Set the value of COD_EQUIPO
     *
     * @return  self
     */
    public function setCOD_EQUIPO($COD_EQUIPO)
    {
        $this->COD_EQUIPO = $COD_EQUIPO;

        return $this;
    }

    /**
     * Get the value of NOMBRE_EQUIPO
     */
    public function getNOMBRE_EQUIPO()
    {
        return $this->NOMBRE_EQUIPO;
    }

    /**
     * Set the value of NOMBRE_EQUIPO
     *
     * @return  self
     */
    public function setNOMBRE_EQUIPO($NOMBRE_EQUIPO)
    {
        $this->NOMBRE_EQUIPO = $NOMBRE_EQUIPO;

        return $this;
    }

    /**
     * Get the value of PRESUPUESTO
     */
    public function getPRESUPUESTO()
    {
        return $this->PRESUPUESTO;
    }

    /**
     * Set the value of PRESUPUESTO
     *
     * @return  self
     */
    public function setPRESUPUESTO($PRESUPUESTO)
    {
        $this->PRESUPUESTO = $PRESUPUESTO;

        return $this;
    }

    /**
     * Get the value of FECHA_FUNDACION
     */
    public function getFECHA_FUNDACION()
    {
        return $this->FECHA_FUNDACION;
    }

    /**
     * Set the value of FECHA_FUNDACION
     *
     * @return  self
     */
    public function setFECHA_FUNDACION($FECHA_FUNDACION)
    {
        $this->FECHA_FUNDACION = $FECHA_FUNDACION;

        return $this;
    }

    /**
     * Get the value of ZONA
     */
    public function getZONA()
    {
        return $this->ZONA;
    }

    /**
     * Set the value of ZONA
     *
     * @return  self
     */
    public function setZONA($ZONA)
    {
        $this->ZONA = $ZONA;

        return $this;
    }

    /**
     * Get the value of TITULOS
     */
    public function getTITULOS()
    {
        return $this->TITULOS;
    }

    /**
     * Set the value of TITULOS
     *
     * @return  self
     */
    public function setTITULOS($TITULOS)
    {
        $this->TITULOS = $TITULOS;

        return $this;
    }

    // Método para obtener todos los registros de la tabla ITEMS
    // Devuelve un array de objetos de la clase ItemModel
    public function getAll()
    {
        //realizamos la consulta de todos los items
        $consulta = $this->db->prepare('SELECT * FROM EQUIPOS');
        $consulta->execute();

        // OJO!! El fetchAll() funcionará correctamente siempre que el nombre
        // de los atributos de la clase coincida con los campos de la tabla
        $resultado = $consulta->fetchAll(PDO::FETCH_CLASS, "EquiposModel");

        //devolvemos la colección para que la vista la presente.
        return $resultado;
    }


    // Método que devuelve (si existe en BD) un objeto ItemModel con un código determinado
    public function getById($codigo)
    {
        $gsent = $this->db->prepare('SELECT * FROM EQUIPOS WHERE COD_EQUIPO = ?');
        $gsent->bindParam(1, $codigo);
        $gsent->execute();

        $gsent->setFetchMode(PDO::FETCH_CLASS, "EquiposModel");
        $resultado = $gsent->fetch();

        return $resultado;
    }

    // Método que almacena en BD un objeto ItemModel
    // Si tiene ya código actualiza el registro y si no tiene lo inserta
    public function save()
    {
        //if ($this->getById($this->getCOD_PARTIDO()) == null) {
        if (!isset($this->COD_EQUIPO)) {
            $consulta = $this->db->prepare('INSERT INTO EQUIPOS(COD_EQUIPO,NOMBRE_EQUIPO,PRESUPUESTO,FECHA_FUNDACION,ZONA,TITULOS) VALUES (?,?,?,?,?,?)');
            $consulta->bindParam(1, $this->COD_EQUIPO);
            $consulta->bindparam(2, $this->NOMBRE_EQUIPO);
            $consulta->bindparam(3, $this->PRESUPUESTO);
            $consulta->bindparam(4, $this->FECHA_FUNDACION);
            $consulta->bindparam(5, $this->ZONA);
            $consulta->bindparam(6, $this->TITULOS);
            $consulta->execute();
        } else {
            $consulta = $this->db->prepare('UPDATE EQUIPOS SET NOMBRE_EQUIPO=?,PRESUPUESTO=?,FECHA_FUNDACION=?,ZONA=?,TITULOS=? WHERE COD_EQUIPO=?');
            $consulta->bindParam(1, $this->NOMBRE_EQUIPO);
            $consulta->bindParam(2, $this->PRESUPUESTO);
            $consulta->bindParam(3, $this->FECHA_FUNDACION);
            $consulta->bindParam(4, $this->ZONA);
            $consulta->bindParam(5, $this->TITULOS);
            $consulta->bindParam(6, $this->COD_EQUIPO);
            $consulta->execute();
        }
    }

    // Método que elimina el ItemModel de la BD
    public function delete()
    {
        $consulta = $this->db->prepare('DELETE FROM EQUIPOS WHERE COD_EQUIPO=?');
        $consulta->bindParam(1, $this->COD_EQUIPO);
        $consulta->execute();
    }
}
