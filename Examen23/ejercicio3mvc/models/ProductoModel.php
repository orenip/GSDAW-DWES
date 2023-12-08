<?php

class ProductoModel {
    // Conexión a la BD
    protected $db;

    private $codigo;
    private $nombre;
    private $precio;
    private $stock;

    public function __construct() {
        //Traemos la única instancia de PDO
        $this->db = SPDO::singleton();
    }

    
    /**
     * Get the value of codigo
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set the value of codigo
     */
    public function setCodigo($codigo): self
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get the value of nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     */
    public function setNombre($nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of precio
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set the value of precio
     */
    public function setPrecio($precio): self
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get the value of stock
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set the value of stock
     */
    public function setStock($stock): self
    {
        $this->stock = $stock;

        return $this;
    }
    

    public function getAll() {
        $consulta = $this->db->prepare('SELECT * FROM productos');
        $consulta->execute();

        $resultado = $consulta->fetchAll(PDO::FETCH_CLASS, "ProductoModel");

        return $resultado;
    }


    public function getById($codigo) {
        $gsent = $this->db->prepare('SELECT * FROM productos WHERE codigo = ?');
        $gsent->bindParam(1, $codigo);
        $gsent->execute();

        $gsent->setFetchMode(PDO::FETCH_CLASS, "ProductoModel");
        $resultado = $gsent->fetch();

        return $resultado;
    }

    public function save() {
        if (!isset($this->codigo)) {
            $consulta = $this->db->prepare('INSERT INTO productos(nombre,precio,stock) VALUES (?,?,?)');
            $consulta->bindParam(1, $this->nombre,PDO::PARAM_STR);
            $consulta->bindParam(2, $this->precio,PDO::PARAM_EVT_EXEC_PRE);
            $consulta->bindParam(3, $this->stock,PDO::PARAM_INT);
            $consulta->execute();
        } else {
            $consulta = $this->db->prepare('UPDATE productos SET nombre=?,precio=?,stock=? WHERE codigo=?');
            $consulta->bindParam(1, $this->nombre,PDO::PARAM_STR);
            $consulta->bindParam(2, $this->precio,PDO::PARAM_EVT_EXEC_PRE);
            $consulta->bindParam(3, $this->stock,PDO::PARAM_INT);
            $consulta->bindParam(4, $this->codigo,PDO::PARAM_INT);
            $consulta->execute();
        }
    }

    public function delete() {
        $consulta = $this->db->prepare('DELETE FROM productos WHERE codigo=?');
        $consulta->bindParam(1, $this->codigo,PDO::PARAM_INT);
        $consulta->execute();
    }
}
?>