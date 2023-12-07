<?php
class EquipoController {
    protected $view;
    function __construct() {
        //Creamos una instancia de nuestro mini motor de plantillas
        $this->view = new View();
    }

    public function listar() {
        require 'models/EquipoModel.php';

        $equipos = new EquipoModel();

        $listado = $equipos->getAll();

        $data['equipos'] = $listado;

        $this->view->show("EquipoListarView.php", $data);
    }

    public function nuevo() {
        require 'models/EquipoModel.php';
        require 'models/ProfesorModel.php';

        $equipo = new EquipoModel();
        $profesor = new ProfesorModel();

        $errores = array();

        if (isset($_REQUEST['submit'])) {
            if (!isset($_REQUEST['curso_equipo']) || empty($_REQUEST['curso_equipo']))
                $errores['curso_equipo'] = "* Descripción: debes indicar el curso_equipo.";
            if (!isset($_REQUEST['profesor_equipo']) || empty($_REQUEST['profesor_equipo']))
                $errores['profesor_equipo'] = "* Descripción: debes indicar el profesor_equipo.";
            if (!isset($_REQUEST['materia_equipo']) || empty($_REQUEST['materia_equipo']))
            $errores['materia_equipo'] = "* Descripción: debes indicar el materia_equipo.";

            if (empty($errores)) {
                $equipo->setProfesorEquipo($_REQUEST['profesor_equipo']);
                $equipo->setMateriaEquipo($_REQUEST['materia_equipo']);
                $equipo->save();

                header("Location: index.php?controlador=Equipo&accion=listar");
            }
        } elseif (isset($_REQUEST['cancel'])) {
            header("Location: index.php?controlador=Equipo&accion=listar");
        }

        $lista_profesores = $profesor->getAll();
        $this->view->show("EquipoNuevoView.php", array('errores' => $errores, 'profesores' => $lista_profesores));
    }

    public function editar() {
        require 'models/CursoModel.php';
        require 'models/NivelEducativoModel.php';

        $equipo = new EquipoModel();
        //$nivel = new NivelEducativoModel();

        $equipo_edit = $equipo->getById($_REQUEST['curso_equipo']);

        if ($equipo_edit == null) {
            $this->view->show("errorView.php", array('error' => 'No existe codigo de curso.'));
        }

        $errores = array();

        if (isset($_REQUEST['submit'])) {
            if (!isset($_REQUEST['profesor_equipo']) || empty($_REQUEST['profesor_equipo']))
                $errores['profesor_equipo'] = "* Descripción: debes indicar un nombre para profesor_equipo.";
            if (!isset($_REQUEST['materia_equipo']) || empty($_REQUEST['materia_equipo']))
                $errores['materia_equipo'] = "* Descripción: debes indicar la materia_equipo.";

            if (empty($errores)) {
                $equipo_edit->setProfesorEquipo($_REQUEST['profesor_equipo']);
                $equipo_edit->setMateriaEquipo($_REQUEST['materia_equipo']);
                $equipo_edit->save();

                header("Location: index.php?controlador=Equipo&accion=listar");
            }
        } elseif (isset($_REQUEST['cancel'])) {
            header("Location: index.php?controlador=Equipo&accion=listar");
        }

       // $lista_niveles = $nivel->getAll();
        $this->view->show("EquipoEditarView.php", array('equipo' => $curso_edit, 'errores' => $errores, 'niveles' => $lista_niveles));
    }

    public function borrar() {
        require_once 'models/EquipoModel.php';

        $equipo = new EquipoModel();

        $equipo_delete = $equipo->getById($_REQUEST['curso_equipo']);

        if ($equipo_delete == null) {
            $this->view->show("errorView.php", array('error' => 'No existe codigo del curso.'));
        } else {
            $equipo_delete->delete();
            header("Location: index.php?controlador=Equipoo&accion=listar");
        }
    }
}
?>