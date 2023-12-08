<?php
class NivelEducativoController {
    protected $view;
    function __construct() {
        //Creamos una instancia de nuestro mini motor de plantillas
        $this->view = new View();
    }

    public function listar() {
        require 'models/NivelEducativoModel.php';

        $niveles = new NivelEducativoModel();

        $listado_niveles = $niveles->getAll();

        $data['niveles'] = $listado_niveles;

        $this->view->show("NivelEducativoListarView.php", $data);
    }

    public function nuevo() {
        require 'models/NivelEducativoModel.php';
        $nivel = new NivelEducativoModel();

        $errores = array();

        if (isset($_REQUEST['submit'])) {
            if (!isset($_REQUEST['desc_nivel']) || empty($_REQUEST['desc_nivel']))
                $errores['desc_nivel'] = "* Descripción: debes indicar un nombre para el nivel educativo.";

            if (empty($errores)) {
                $nivel->setDescNivel($_REQUEST['desc_nivel']);
                $nivel->save();

                header("Location: index.php?controlador=NivelEducativo&accion=listar");
            }
        } elseif (isset($_REQUEST['cancel'])) {
            header("Location: index.php?controlador=NivelEducativo&accion=listar");
        }

        $this->view->show("NivelEducativoNuevoView.php", array('errores' => $errores));
    }

    public function editar() {

        require 'models/NivelEducativoModel.php';
        $nivel = new NivelEducativoModel();

        $nivel_edit = $nivel->getById($_REQUEST['cod_nivel']);

        if ($nivel_edit == null) {
            $this->view->show("errorView.php", array('error' => 'No existe codigo de nivel educativo.'));
        }

        $errores = array();

        if (isset($_REQUEST['submit'])) {
            if (!isset($_REQUEST['desc_nivel']) || empty($_REQUEST['desc_nivel']))
                $errores['desc_nivel'] = "* Descripción: es obligatorio el nombre del nivel educativo.";

            if (empty($errores)) {
                $nivel_edit->setDescNivel($_REQUEST['desc_nivel']);
                $nivel_edit->save();

                header("Location: index.php?controlador=NivelEducativo&accion=listar");
            }
        } elseif (isset($_REQUEST['cancel'])) {
            header("Location: index.php?controlador=NivelEducativo&accion=listar");
        }

        $this->view->show("NivelEducativoEditarView.php", array('nivel' => $nivel_edit, 'errores' => $errores));
    }

    public function borrar() {
        require_once 'models/NivelEducativoModel.php';

        $nivel = new NivelEducativoModel();

        $nivel_delete = $nivel->getById($_REQUEST['cod_nivel']);

        if ($nivel_delete == null) {
            $this->view->show("errorView.php", array('error' => 'No existe codigo del nivel educativo.'));
        } else {
            $nivel_delete->delete();
            header("Location: index.php?controlador=NivelEducativo&accion=listar");
        }
    }
}
?>