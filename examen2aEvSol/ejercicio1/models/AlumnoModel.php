<?php

// Clase del modelo para trabajar con objetos alumnos
class AlumnoModel
{
    // Conexión a la BD
    protected $db;

    // Atributos del objeto item que coinciden con los campos de la tabla ITEMS
    private $alu_id;
    private $alu_nombre;
    private $alu_empresa;
    private $alu_apto;

    

    // Constructor que utiliza el patrón Singleton para tener una única instancia de la conexión a BD
    public function __construct()
    {
        //Traemos la única instancia de PDO
        $this->db = SPDO::singleton();
    }

    // Getters y Setters
    public function getId()
    {
        return $this->alu_id;
    }
    public function setId($id)
    {
        $this->alu_id = $id;
    }

    public function getNombre()
    {
        return $this->alu_nombre;
    }
    public function setNombre($nombre)
    {
        $this->alu_nombre = $nombre;
    }

    public function getEmpresa()
    {
        return $this->alu_empresa;
    }

    public function setEmpresa($emp)
    {
        $this->alu_empresa=$emp;
    }

    public function getApto()
    {
        return $this->alu_apto;
    }

    public function setApto($apt)
    {
        $this->alu_apto=$apt;
    }

    // Método para obtener todos los registros de la tabla alumnos
    // Devuelve un array de objetos de la clase AlumnoModel
    public function getAll()
    {
        //realizamos la consulta de todos los items
        $consulta = $this->db->prepare('SELECT * FROM alumnos');
        $consulta->execute();
        $resultado = $consulta->fetchAll(PDO::FETCH_CLASS, "AlumnoModel");

        //devolvemos la colección para que la vista la presente.
        return $resultado;
    }


    // Método que devuelve (si existe en BD) un objeto ItemModel con un código determinado
    public function getById($id)
    {
        $gsent = $this->db->prepare('SELECT * FROM alumnos where alu_id = ?');
        $gsent->bindParam(1, $id);
        $gsent->execute();

        $gsent->setFetchMode(PDO::FETCH_CLASS, "AlumnoModel");
        $resultado = $gsent->fetch();

        return $resultado;
    }

    // Método que almacena en BD un objeto ItemModel
    // Si tiene ya código actualiza el registro y si no tiene lo inserta
    public function save()
    {
        if (!isset($this->alu_id)) {
            $consulta = $this->db->prepare('INSERT INTO alumnos ( alu_nombre,alu_empresa,alu_apto ) values ( ?,?,? )');
            $consulta->bindParam(1, $this->alu_nombre);
            $consulta->bindParam(2, $this->alu_empresa);
            $consulta->bindParam(3, $this->alu_apto);

            $consulta->execute();
        } else {
            $consulta = $this->db->prepare('UPDATE alumnos SET alu_nombre=?,alu_empresa=?,alu_apto=? WHERE alu_id =  ? ');
            $consulta->bindParam(1, $this->alu_nombre);
            $consulta->bindParam(2, $this->alu_empresa);
            $consulta->bindParam(3, $this->alu_apto);
            $consulta->bindParam(4, $this->alu_id);


            $consulta->execute();
        }
    }

    /*
        alu_id integer not null auto_increment,
    alu_nombre varchar(80) not null,
    alu_empresa integer,
    alu_apto boolean not null default false,
    
    */ 


    // Método que elimina el ItemModel de la BD
    public function delete()
    {
        $consulta = $this->db->prepare('DELETE FROM  alumnos WHERE alu_id =  ?');
        $consulta->bindParam(1, $this->alu_id);
        $consulta->execute();
    }

    //metodo que devuelve todos los alumnos asociados
    public function alumnosAsociados($id)
    {
        $consulta = $this->db->prepare('SELECT * FROM alumnos where alu_empresa = ?');
        $consulta->bindParam(1, $id);
        $consulta->execute();
        var_dump($consulta); 
             
        $resultados = $consulta->fetchAll(PDO::FETCH_CLASS, "AlumnoModel");
        var_dump($resultados);
            foreach($resultados as $alu)
            {
                $alu->setApto("1");
                $alu->save();
            }     
        

    




    }


}
?>