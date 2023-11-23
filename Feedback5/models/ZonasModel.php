<?php

// Clase del modelo para trabajar con objetos Item que se almacenan en BD en la tabla ITEMS
class ZonasModel
{
    // Conexión a la BD
    protected $db;

    // Atributos del objeto item que coinciden con los campos de la tabla ITEMS

    private $COD_ZONA;
    private $NOMBRE_ZONA;



    // Constructor que utiliza el patrón Singleton para tener una única instancia de la conexión a BD
    public function __construct()
    {
        //Traemos la única instancia de PDO
        $this->db = SPDO::singleton();
    }

    // Getters y Setters
    
    /**
     * Get the value of COD_ZONA
     */ 
    public function getCOD_ZONA()
    {
        return $this->COD_ZONA;
    }

    /**
     * Set the value of COD_ZONA
     *
     * @return  self
     */ 
    public function setCOD_ZONA($COD_ZONA)
    {
        $this->COD_ZONA = $COD_ZONA;

        return $this;
    }

    /**
     * Get the value of NOMBRE_ZONA
     */ 
    public function getNOMBRE_ZONA()
    {
        return $this->NOMBRE_ZONA;
    }

    /**
     * Set the value of NOMBRE_ZONA
     *
     * @return  self
     */ 
    public function setNOMBRE_ZONA($NOMBRE_ZONA)
    {
        $this->NOMBRE_ZONA = $NOMBRE_ZONA;

        return $this;
    }

    // Método para obtener todos los registros de la tabla ITEMS
    // Devuelve un array de objetos de la clase ItemModel
    public function getAll()
    {
        //realizamos la consulta de todos los items
        $consulta = $this->db->prepare('SELECT * FROM ZONAS');
        $consulta->execute();

        // OJO!! El fetchAll() funcionará correctamente siempre que el nombre
        // de los atributos de la clase coincida con los campos de la tabla
        $resultado = $consulta->fetchAll(PDO::FETCH_CLASS, "ZonasModel");

        //devolvemos la colección para que la vista la presente.
        return $resultado;
    }


    // Método que devuelve (si existe en BD) un objeto ItemModel con un código determinado
    public function getById($codigo)
    {
        $gsent = $this->db->prepare('SELECT * FROM ZONAS WHERE COD_ZONA = ?');
        $gsent->bindParam(1, $codigo);
        $gsent->execute();

        $gsent->setFetchMode(PDO::FETCH_CLASS, "ZonasModel");
        $resultado = $gsent->fetch();

        return $resultado;
    }

    // Método que almacena en BD un objeto ItemModel
    // Si tiene ya código actualiza el registro y si no tiene lo inserta
    public function save()
    {
        if ($this->getById($this->getCOD_ZONA()) == null) {
            $consulta = $this->db->prepare('INSERT INTO ZONAS(COD_ZONA,NOMBRE_ZONA) VALUES (?,?)');
            $consulta->bindParam(1, $this->COD_ZONA);
            $consulta->bindparam(2, $this->NOMBRE_ZONA);
            $consulta->execute();
        } else {
            $consulta = $this->db->prepare('UPDATE ZONAS SET NOMBRE_ZONA=? WHERE COD_ZONA=?');
            $consulta->bindParam(1, $this->NOMBRE_ZONA);
            $consulta->bindParam(2, $this->COD_ZONA);
            $consulta->execute();
        }
    }

    // Método que elimina el ItemModel de la BD
    public function delete()
    {
        $consulta = $this->db->prepare('DELETE FROM ZONAS WHERE COD_ZONA=?');
        $consulta->bindParam(1, $this->COD_ZONA);
        $consulta->execute();
    }

   

}
