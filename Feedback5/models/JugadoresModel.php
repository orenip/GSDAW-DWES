<?php

// Clase del modelo para trabajar con objetos Item que se almacenan en BD en la tabla ITEMS
class JugadoresModel
{
    // Conexión a la BD
    protected $db;

    // Atributos del objeto item que coinciden con los campos de la tabla ITEMS

    private $COD_JUGADOR;
    private $NOMBRE_JUGADOR;
    private $FECHA_NACIMIENTO;
    private $ESTATURA;
    private $POSICION;
    private $EQUIPO;



    // Constructor que utiliza el patrón Singleton para tener una única instancia de la conexión a BD
    public function __construct()
    {
        //Traemos la única instancia de PDO
        $this->db = SPDO::singleton();
    }

    // Getters y Setters
    /**
     * Get the value of COD_JUGADOR
     */
    public function getCOD_JUGADOR()
    {
        return $this->COD_JUGADOR;
    }

    /**
     * Set the value of COD_JUGADOR
     */
    public function setCOD_JUGADOR($COD_JUGADOR): self
    {
        $this->COD_JUGADOR = $COD_JUGADOR;

        return $this;
    }

    /**
     * Get the value of NOMBRE_JUGADOR
     */
    public function getNOMBRE_JUGADOR()
    {
        return $this->NOMBRE_JUGADOR;
    }

    /**
     * Set the value of NOMBRE_JUGADOR
     */
    public function setNOMBRE_JUGADOR($NOMBRE_JUGADOR): self
    {
        $this->NOMBRE_JUGADOR = $NOMBRE_JUGADOR;

        return $this;
    }

    /**
     * Get the value of FECHA_NACIMIENTO
     */
    public function getFECHA_NACIMIENTO()
    {
        return $this->FECHA_NACIMIENTO;
    }

    /**
     * Set the value of FECHA_NACIMIENTO
     */
    public function setFECHA_NACIMIENTO($FECHA_NACIMIENTO): self
    {
        $this->FECHA_NACIMIENTO = $FECHA_NACIMIENTO;

        return $this;
    }

    /**
     * Get the value of ESTATURA
     */
    public function getESTATURA()
    {
        return $this->ESTATURA;
    }

    /**
     * Set the value of ESTATURA
     */
    public function setESTATURA($ESTATURA): self
    {
        $this->ESTATURA = $ESTATURA;

        return $this;
    }

    /**
     * Get the value of POSICION
     */
    public function getPOSICION()
    {
        return $this->POSICION;
    }

    /**
     * Set the value of POSICION
     */
    public function setPOSICION($POSICION): self
    {
        $this->POSICION = $POSICION;

        return $this;
    }

    /**
     * Get the value of EQUIPO
     */
    public function getEQUIPO()
    {
        return $this->EQUIPO;
    }

    /**
     * Set the value of EQUIPO
     */
    public function setEQUIPO($EQUIPO): self
    {
        $this->EQUIPO = $EQUIPO;

        return $this;
    }

    // Método para obtener todos los registros de la tabla ITEMS
    // Devuelve un array de objetos de la clase ItemModel
    public function getAll()
    {
        //realizamos la consulta de todos los items
        $consulta = $this->db->prepare('SELECT * FROM JUGADORES');
        $consulta->execute();

        // OJO!! El fetchAll() funcionará correctamente siempre que el nombre
        // de los atributos de la clase coincida con los campos de la tabla
        $resultado = $consulta->fetchAll(PDO::FETCH_CLASS, "JugadoresModel");

        //devolvemos la colección para que la vista la presente.
        return $resultado;
    }


    // Método que devuelve (si existe en BD) un objeto ItemModel con un código determinado
    public function getById($codigo)
    {
        $gsent = $this->db->prepare('SELECT * FROM JUGADORES WHERE COD_JUGADOR = ?');
        $gsent->bindParam(1, $codigo);
        $gsent->execute();

        $gsent->setFetchMode(PDO::FETCH_CLASS, "JugadoresModel");
        $resultado = $gsent->fetch();

        return $resultado;
    }

    // Método que almacena en BD un objeto ItemModel
    // Si tiene ya código actualiza el registro y si no tiene lo inserta
    public function save()
    {
        //if ($this->getById($this->getCOD_PARTIDO()) == null) {
        if (!isset($this->COD_JUGADOR)) {
            $consulta = $this->db->prepare('INSERT INTO JUGADORES(COD_JUGADOR,NOMBRE_JUGADOR,FECHA_NACIMIENTO,ESTATURA,POSICION,EQUIPO) VALUES (?,?,?,?,?,?)');
            $consulta->bindParam(1, $this->COD_JUGADOR);
            $consulta->bindparam(2, $this->NOMBRE_JUGADOR);
            $consulta->bindparam(3, $this->FECHA_NACIMIENTO);
            $consulta->bindparam(4, $this->ESTATURA);
            $consulta->bindparam(5, $this->POSICION);
            $consulta->bindparam(6, $this->EQUIPO);
            $consulta->execute();
        } else {
            $consulta = $this->db->prepare('UPDATE JUGADORES SET NOMBRE_JUGADOR=?,FECHA_NACIMIENTO=?,ESTATURA=?,POSICION=?,EQUIPO=? WHERE COD_JUGADOR=?');
            $consulta->bindParam(1, $this->NOMBRE_JUGADOR);
            $consulta->bindParam(2, $this->FECHA_NACIMIENTO);
            $consulta->bindParam(3, $this->ESTATURA);
            $consulta->bindParam(4, $this->POSICION);
            $consulta->bindParam(5, $this->EQUIPO);
            $consulta->bindParam(6, $this->COD_JUGADOR);
            $consulta->execute();
        }
    }

    // Método que elimina el ItemModel de la BD
    public function delete()
    {
        $consulta = $this->db->prepare('DELETE FROM JUGADORES WHERE COD_JUGADOR=?');
        $consulta->bindParam(1, $this->COD_JUGADOR);
        $consulta->execute();
    }

   
}
