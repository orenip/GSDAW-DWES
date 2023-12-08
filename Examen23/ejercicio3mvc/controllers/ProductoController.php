<?php
class ProductoController {
    protected $view;
    function __construct() {
        //Creamos una instancia de nuestro mini motor de plantillas
        $this->view = new View();
    }

    public function listar() {
        require 'models/ProductoModel.php';

        $productos = new ProductoModel();

        $listado_productos = $productos->getAll();

        $data['productos'] = $listado_productos;

        $this->view->show("ProductoListarView.php", $data);
    }

    public function nuevo() {
        require 'models/ProductoModel.php';
        $producto = new ProductoModel();

        $errores = array();

        if (isset($_REQUEST['submit'])) {
            if (!isset($_REQUEST['nombre']) || empty($_REQUEST['nombre']))
                $errores['nombre'] = "* Descripción: debes indicar un nombre para el producto.";
            if (!isset($_REQUEST['precio']) || empty($_REQUEST['precio']))
                $errores['precio'] = "* Descripción: debes indicar un precio para el producto.";
            if (!isset($_REQUEST['stock']) || empty($_REQUEST['stock']))
                $errores['stock'] = "* Descripción: debes indicar un stock para el producto.";

            if (empty($errores)) {
                $producto->setNombre($_REQUEST['nombre']);
                $producto->setPrecio($_REQUEST['precio']);
                $producto->setStock($_REQUEST['stock']);
                $producto->save();

                header("Location: index.php?controlador=Producto&accion=listar");
            }
        } elseif (isset($_REQUEST['cancel'])) {
            header("Location: index.php?controlador=Producto&accion=listar");
        }

        $this->view->show("ProductoNuevoView.php", array('errores' => $errores));
    }

    public function editar() {

        require 'models/ProductoModel.php';
        $producto = new ProductoModel();

        $producto_edit = $producto->getById($_REQUEST['codigo']);

        if ($producto_edit == null) {
            $this->view->show("errorView.php", array('error' => 'No existe codigo de producto.'));
        }

        $errores = array();

        if (isset($_REQUEST['submit'])) {
            if (!isset($_REQUEST['nombre']) || empty($_REQUEST['nombre']))
                $errores['nombre'] = "* Descripción: debes indicar un nombre para el producto.";
            if (!isset($_REQUEST['precio']) || empty($_REQUEST['precio']))
                $errores['precio'] = "* Descripción: debes indicar un precio para el producto.";
            if (!isset($_REQUEST['stock']) || empty($_REQUEST['stock']))
                $errores['stock'] = "* Descripción: debes indicar un stock para el producto.";

            if (empty($errores)) {
                $producto_edit->setNombre($_REQUEST['nombre']);
                $producto_edit->setPrecio($_REQUEST['precio']);
                $producto_edit->setStock($_REQUEST['stock']);
                $producto_edit->save();

                header("Location: index.php?controlador=Producto&accion=listar");
            }
        } elseif (isset($_REQUEST['cancel'])) {
            header("Location: index.php?controlador=Producto&accion=listar");
        }

        $this->view->show("ProductoEditarView.php", array('producto' => $producto_edit, 'errores' => $errores));
    }

    public function borrar() {
        require_once 'models/ProductoModel.php';

        $producto = new ProductoModel();

        $producto_delete = $producto->getById($_REQUEST['codigo']);

        if ($producto_delete == null) {
            $this->view->show("errorView.php", array('error' => 'No existe codigo del producto.'));
        } else {
            $producto_delete->delete();
            header("Location: index.php?controlador=Producto&accion=listar");
        }
    }
}
?>