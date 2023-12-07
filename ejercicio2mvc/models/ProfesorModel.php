<?php

class ProfesorModel {
    // Conexión a la BD
    protected $db;

    private $cod_profesor;

    private $nombre_profesor;


    public function __construct() {
        //Traemos la única instancia de PDO
        $this->db = SPDO::singleton();
    }

     /**
     * Get the value of cod_profesor
     */
    public function getCodProfesor()
    {
        return $this->cod_profesor;
    }

    /**
     * Set the value of cod_profesor
     */
    public function setCodProfesor($cod_profesor): self
    {
        $this->cod_profesor = $cod_profesor;

        return $this;
    }

    /**
     * Get the value of nombre_profesor
     */
    public function getNombreProfesor()
    {
        return $this->nombre_profesor;
    }

    /**
     * Set the value of nombre_profesor
     */
    public function setNombreProfesor($nombre_profesor): self
    {
        $this->nombre_profesor = $nombre_profesor;

        return $this;
    }
  
    
    public function getAll() {
        $consulta = $this->db->prepare('SELECT * FROM profesor');
        $consulta->execute();

        $resultado = $consulta->fetchAll(PDO::FETCH_CLASS, "ProfesorModel");

        return $resultado;
    }


    public function getById($codigo) {
        $gsent = $this->db->prepare('SELECT * FROM profesor WHERE cod_profesor = ?');
        $gsent->bindParam(1, $codigo);
        $gsent->execute();

        $gsent->setFetchMode(PDO::FETCH_CLASS, "ProfesorModel");
        $resultado = $gsent->fetch();

        return $resultado;
    }

    public function save() {
        if (!isset($this->cod_profesor)) {
            $consulta = $this->db->prepare('INSERT INTO profesor(nombre_profesor) VALUES (?)');
            $consulta->bindParam(1, $this->nombre_profesor,PDO::PARAM_STR);
            $consulta->execute();
        } else {
            $consulta = $this->db->prepare('UPDATE profesor SET nombre_profesor=? WHERE cod_profesor=?');
            $consulta->bindParam(1, $this->nombre_profesor,PDO::PARAM_STR);
            $consulta->bindParam(2, $this->cod_profesor,PDO::PARAM_INT);
            $consulta->execute();
        }
    }

    public function delete() {
        $consulta = $this->db->prepare('DELETE FROM profesor WHERE cod_profesor=?');
        $consulta->bindParam(1, $this->cod_profesor);
        $consulta->execute();
    }

  
}
?>