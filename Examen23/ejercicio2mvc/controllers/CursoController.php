<?php
class CursoController {
    protected $view;
    function __construct() {
        //Creamos una instancia de nuestro mini motor de plantillas
        $this->view = new View();
    }

    public function listar() {
        require 'models/CursoModel.php';

        $cursos = new CursoModel();

        $listado_cursos = $cursos->getAll();

        $data['cursos'] = $listado_cursos;

        $this->view->show("CursoListarView.php", $data);
    }

    public function nuevo() {
        require 'models/CursoModel.php';
        require 'models/NivelEducativoModel.php';

        $curso = new CursoModel();
        $nivel = new NivelEducativoModel();

        $errores = array();

        if (isset($_REQUEST['submit'])) {
            if (!isset($_REQUEST['desc_curso']) || empty($_REQUEST['desc_curso']))
                $errores['desc_curso'] = "* Descripción: debes indicar un nombre para el curso.";
            if (!isset($_REQUEST['nivel_curso']) || empty($_REQUEST['nivel_curso']))
                $errores['nivel_curso'] = "* Descripción: debes indicar el nivel del curso.";

            if (empty($errores)) {
                $curso->setDescCurso($_REQUEST['desc_curso']);
                $curso->setNivelCurso($_REQUEST['nivel_curso']);
                $curso->save();

                header("Location: index.php?controlador=Curso&accion=listar");
            }
        } elseif (isset($_REQUEST['cancel'])) {
            header("Location: index.php?controlador=Curso&accion=listar");
        }

        $lista_niveles = $nivel->getAll();
        $this->view->show("CursoNuevoView.php", array('errores' => $errores, 'niveles' => $lista_niveles));
    }

    public function editar() {
        require 'models/CursoModel.php';
        require 'models/NivelEducativoModel.php';

        $curso = new CursoModel();
        $nivel = new NivelEducativoModel();

        $curso_edit = $curso->getById($_REQUEST['cod_curso']);

        if ($curso_edit == null) {
            $this->view->show("errorView.php", array('error' => 'No existe codigo de curso.'));
        }

        $errores = array();

        if (isset($_REQUEST['submit'])) {
            if (!isset($_REQUEST['desc_curso']) || empty($_REQUEST['desc_curso']))
                $errores['desc_curso'] = "* Descripción: debes indicar un nombre para el curso.";
            if (!isset($_REQUEST['nivel_curso']) || empty($_REQUEST['nivel_curso']))
                $errores['nivel_curso'] = "* Descripción: debes indicar el nivel del curso.";

            if (empty($errores)) {
                $curso_edit->setDescCurso($_REQUEST['desc_curso']);
                $curso_edit->setNivelCurso($_REQUEST['nivel_curso']);
                $curso_edit->save();

                header("Location: index.php?controlador=Curso&accion=listar");
            }
        } elseif (isset($_REQUEST['cancel'])) {
            header("Location: index.php?controlador=Curso&accion=listar");
        }

        $lista_niveles = $nivel->getAll();
        $this->view->show("CursoEditarView.php", array('curso' => $curso_edit, 'errores' => $errores, 'niveles' => $lista_niveles));
    }

    public function borrar() {
        require_once 'models/CursoModel.php';

        $curso = new CursoModel();

        $curso_delete = $curso->getById($_REQUEST['cod_curso']);

        if ($curso_delete == null) {
            $this->view->show("errorView.php", array('error' => 'No existe codigo del curso.'));
        } else {
            $curso_delete->delete();
            header("Location: index.php?controlador=Curso&accion=listar");
        }
    }
}
?>