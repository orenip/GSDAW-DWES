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

        $listado_profes = $profesores->getAll();

        $data['profes'] = $listado_profes;

        $this->view->show("ProfesorListarView.php", $data);
    }

    public function nuevo() {
        require 'models/ProfesorModel.php';
        
        $profe = new ProfesorModel();
        
        $errores = array();

        if (isset($_REQUEST['submit'])) {
            if (!isset($_REQUEST['nombre_profesor']) || empty($_REQUEST['nombre_profesor']))
                $errores['nombre_profesor'] = "* Descripción: debes indicar un nombre para el profesor.";
            
            if (empty($errores)) {
                $profe->setNombreProfesor($_REQUEST['nombre_profesor']);
                $profe->save();

                header("Location: index.php?controlador=Profesor&accion=listar");
            }
        } elseif (isset($_REQUEST['cancel'])) {
            header("Location: index.php?controlador=Profesor&accion=listar");
        }

        $this->view->show("ProfesorNuevoView.php", array('errores' => $errores));
    }

    public function editar() {
        require 'models/ProfesorModel.php';
        
        $profe = new ProfesorModel();

        $profe_edit = $profe->getById($_REQUEST['cod_profesor']);

        if ($profe_edit == null) {
            $this->view->show("errorView.php", array('error' => 'No existe codigo de curso.'));
        }

        $errores = array();

        if (isset($_REQUEST['submit'])) {
            if (!isset($_REQUEST['nombre_profesor']) || empty($_REQUEST['nombre_profesor']))
                $errores['nombre_profesor'] = "* Descripción: debes indicar un nombre para el profesor.";

            if (empty($errores)) {
                $profe_edit->setNombreProfesor($_REQUEST['nombre_profesor']);
                $profe_edit->save();

                header("Location: index.php?controlador=Profesor&accion=listar");
            }
        } elseif (isset($_REQUEST['cancel'])) {
            header("Location: index.php?controlador=Profesor&accion=listar");
        }

        $this->view->show("ProfesorEditarView.php", array('profe' => $profe_edit, 'errores' => $errores));
    }

    public function borrar() {
        require_once 'models/ProfesorModel.php';

        $profe = new ProfesorModel();

        $profe_delete = $profe->getById($_REQUEST['cod_profesor']);

        if ($profe_delete == null) {
            $this->view->show("errorView.php", array('error' => 'No existe codigo del profesor.'));
        } else {
            $profe_delete->delete();
            header("Location: index.php?controlador=Profesor&accion=listar");
        }
    }
}
?>