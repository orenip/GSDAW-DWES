<?php
class EquipoDocenteController {
    protected $view;
    function __construct() {
        //Creamos una instancia de nuestro mini motor de plantillas
        $this->view = new View();
    }

    /**
     * Para el controlador de EquipoDocente, siempre se listará el equipo docente de un curso 
     * determinado, por lo que siempre se esperará ese valor
     * @return void
     */
    public function listarCurso() {
        require 'models/EquipoDocenteModel.php';
        require 'models/CursoModel.php';

        $equipo_docente = new EquipoDocenteModel();
        $curso_model = new CursoModel();

        if (isset($_REQUEST['curso_equipo'])) {
            $listado_profes = $equipo_docente->getByCurso($_REQUEST['curso_equipo']);

            $data['cod_curso'] = $_REQUEST['curso_equipo'];
            $curso = $curso_model->getById($_REQUEST['curso_equipo']);
            $data['desc_curso'] = $curso->getDescCurso();
            $data['profes'] = $listado_profes;

            $this->view->show("EquipoDocenteListarView.php", $data);
        } else {
            $this->view->show("errorView.php", array('error' => 'No se ha recibido el curso para mostrar su equipo docente.'));
        }
    }

    public function nuevo() {
        require 'models/EquipoDocenteModel.php';
        require 'models/ProfesorModel.php';

        $equipo_model = new EquipoDocenteModel();
        $profesor = new ProfesorModel();

        $errores = array();

        if (isset($_REQUEST['submit'])) {
            if (!isset($_REQUEST['profesor_equipo']) || empty($_REQUEST['profesor_equipo']))
                $errores['profesor_equipo'] = "* Descripción: debes indicar el profesor del curso.";
            if (!isset($_REQUEST['materia_equipo']) || empty($_REQUEST['materia_equipo']))
                $errores['profesor_curso'] = "* Descripción: debes indicar la materia.";

            if (empty($errores)) {
                $equipo_model->setCursoEquipo($_REQUEST['curso_equipo']);
                $equipo_model->setProfesorEquipo($_REQUEST['profesor_equipo']);
                $equipo_model->setMateriaEquipo($_REQUEST['materia_equipo']);
                $equipo_model->insert();

                header("Location: index.php?controlador=EquipoDocente&accion=listarCurso&curso_equipo=" . $_REQUEST['curso_equipo']);
            }
        } elseif (isset($_REQUEST['cancel'])) {
            header("Location: index.php?controlador=EquipoDocente&accion=listarCurso&curso_equipo=" . $_REQUEST['curso_equipo']);
        }

        $lista_profes = $profesor->getAll();
        $this->view->show("EquipoDocenteNuevoView.php", array('errores' => $errores, 'profes' => $lista_profes, 'curso_equipo' => $_REQUEST['cod_curso']));
    }

    public function editar() {
        require 'models/EquipoDocenteModel.php';
        require 'models/ProfesorModel.php';

        $equipo_model = new EquipoDocenteModel();
        $profesor_model = new ProfesorModel();

        $equipo_edit = $equipo_model->getById($_REQUEST['curso_equipo'], $_REQUEST['profesor_equipo']);

        if ($equipo_edit == null) {
            $this->view->show("errorView.php", array('error' => 'No existe ese profesor en el curso.'));
        }

        $errores = array();

        if (isset($_REQUEST['submit'])) {
            if (!isset($_REQUEST['profesor_equipo_new']) || empty($_REQUEST['profesor_equipo_new']))
                $errores['profesor_equipo_new'] = "* Descripción: debes indicar el profesor del curso.";
            if (!isset($_REQUEST['materia_equipo']) || empty($_REQUEST['materia_equipo']))
                $errores['materia_equipo'] = "* Descripción: debes indicar la materia.";

            if (empty($errores)) {
                $equipo_edit->setProfesorEquipo($_REQUEST['profesor_equipo']);
                $equipo_edit->setMateriaEquipo($_REQUEST['materia_equipo']);
                $equipo_edit->update($_REQUEST['profesor_equipo_new']);
                header("Location: index.php?controlador=EquipoDocente&accion=listarCurso&curso_equipo=" . $_REQUEST['curso_equipo']);
            }
        } elseif (isset($_REQUEST['cancel'])) {
            header("Location: index.php?controlador=EquipoDocente&accion=listarCurso&curso_equipo=" . $_REQUEST['curso_equipo']);
        }

        $lista_profes = $profesor_model->getAll();
        $this->view->show("EquipoDocenteEditarView.php", array('equipo' => $equipo_edit, 'errores' => $errores, 'profes' => $lista_profes));
    }

    public function borrar() {
        require_once 'models/EquipoDocenteModel.php';

        $equipo_model = new EquipoDocenteModel();

        $equipo = $equipo_model->getById($_REQUEST['curso_equipo'], $_REQUEST['profesor_equipo']);

        if ($equipo == null) {
            $this->view->show("errorView.php", array('error' => 'No existe el profesor en este curso.'));
        } else {
            $equipo->delete();
            header("Location: index.php?controlador=EquipoDocente&accion=listarCurso&curso_equipo=" . $_REQUEST['curso_equipo']);
        }
    }
}
?>