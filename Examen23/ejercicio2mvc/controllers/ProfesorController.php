<?php
class ProfesorController {
    protected $view;
    function __construct() {
        //Creamos una instancia de nuestro mini motor de plantillas
        $this->view = new View();
    }

    public function listar() {
        require 'models/ProfesorModel.php';

        $profesores = new ProfesorModel();

        $listado= $profesores->getAll();

        $data['profesores'] = $listado;

        $this->view->show("ProfesorListarView.php", $data);
    }

    public function nuevo() {
        require 'models/ProfesorModel.php';

        $profesor = new ProfesorModel();

        $errores = array();

        if (isset($_REQUEST['submit'])) {
            if (!isset($_REQUEST['nombre_profesor']) || empty($_REQUEST['nombre_profesor']))
                $errores['nombre_profesor'] = "* Descripción: debes indicar un nombre para el profesor.";

            if (empty($errores)) {
                $profesor->setNombreProfesor($_REQUEST['nombre_profesor']);
                $profesor->save();

                header("Location: index.php?controlador=Profesor&accion=listar");
            }
        } elseif (isset($_REQUEST['cancel'])) {
            header("Location: index.php?controlador=Profesor&accion=listar");
        }

        $this->view->show("ProfesorNuevoView.php", array('errores' => $errores));
    }

    public function editar() {
        require 'models/ProfesorModel.php';

        $profesor = new ProfesorModel();

        $profesor_edit = $profesor->getById($_REQUEST['cod_profesor']);

        if ($profesor_edit == null) {
            $this->view->show("errorView.php", array('error' => 'No existe codigo de profesor.'));
        }

        $errores = array();

        if (isset($_REQUEST['submit'])) {
            if (!isset($_REQUEST['nombre_profesor']) || empty($_REQUEST['nombre_profesor']))
                $errores['nombre_profesor'] = "* Descripción: debes indicar un nombre para el profesor.";


            if (empty($errores)) {
                $profesor_edit->setNombreProfesor($_REQUEST['nombre_profesor']);
                $profesor_edit->save();

                header("Location: index.php?controlador=Profesor&accion=listar");
            }
        } elseif (isset($_REQUEST['cancel'])) {
            header("Location: index.php?controlador=Profesor&accion=listar");
        }

        $this->view->show("ProfesorEditarView.php", array('profesor' => $profesor_edit, 'errores' => $errores));
    }

    public function borrar() {
        require_once 'models/ProfesorModel.php';

        $profesor = new ProfesorModel();

        $profesor_delete = $profesor->getById($_REQUEST['cod_profesor']);

        if ($profesor_delete == null) {
            $this->view->show("errorView.php", array('error' => 'No existe codigo del profesor.'));
        } else {
            $profesor_delete->delete();
            header("Location: index.php?controlador=Profesor&accion=listar");
        }
    }
}
?>