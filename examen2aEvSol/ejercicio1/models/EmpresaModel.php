<?php

// Clase del modelo para trabajar con objetos EmpresaModel que se almacenan en BD en la tabla empresas
class EmpresaModel
{
    // Conexión a la BD
    protected $db;

    // Atributos del objeto item que coinciden con los campos de la tabla ITEMS
    private $emp_id;
    private $emp_nombre;


    /*
        emp_id integer not null auto_increment,
    emp_nombre varchar(50),
    */

    // Constructor que utiliza el patrón Singleton para tener una única instancia de la conexión a BD
    public function __construct()
    {
        //Traemos la única instancia de PDO
        $this->db = SPDO::singleton();
    }

    // Getters y Setters
    public function getId()
    {
        return $this->emp_id;
    }
    public function setId($id)
    {
         $this->emp_id = $id;
    }

    public function getNombre()
    {
        return $this->emp_nombre;
    }
    public function setNombre($nombre)
    {
         $this->emp_nombre = $nombre;
    }

    // Método para obtener todos los registros de la tabla ITEMS
    // Devuelve un array de objetos de la clase ItemModel
    public function getAll()
    {
        //realizamos la consulta de todos los items
        $consulta = $this->db->prepare('SELECT * FROM empresas');
        $consulta->execute();
        $resultado = $consulta->fetchAll(PDO::FETCH_CLASS, "EmpresaModel");

        //devolvemos la colección para que la vista la presente.
        return $resultado;
    }


    // Método que devuelve (si existe en BD) un objeto ItemModel con un código determinado
    public function getById($id)
    {
        $gsent = $this->db->prepare('SELECT * FROM empresas where emp_id = ?');
        $gsent->bindParam(1, $id);
        $gsent->execute();

        $gsent->setFetchMode(PDO::FETCH_CLASS, "EmpresaModel");
        $resultado = $gsent->fetch();

        return $resultado;
    }

    // Método que almacena en BD un objeto EmpresaModel
    // Si tiene ya código actualiza el registro y si no tiene lo inserta
    public function save()
    {
        if (!isset($this->emp_id)) {
            $consulta = $this->db->prepare('INSERT INTO empresas ( emp_nombre ) values ( ? )');
            $consulta->bindParam(1, $this->emp_nombre);
            $consulta->execute();
        } else {
            $consulta = $this->db->prepare('UPDATE empresas SET emp_nombre = ? WHERE emp_id =  ? ');
            $consulta->bindParam(1, $this->emp_nombre);
            $consulta->bindParam(2, $this->emp_id);
            $consulta->execute();
        }
    }

    // Método que elimina el ItemModel de la BD
    public function delete()
    {
        $consulta = $this->db->prepare('DELETE FROM  empresas WHERE emp_id =  ?');
        $consulta->bindParam(1, $this->emp_id);
        $consulta->execute();
    }

    

}
?>