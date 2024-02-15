<?php
// Controlador para el modelo ItemModel (puede haber más controladores en la aplicación)
// Un controlador no tiene porque estar asociado a un objeto del modelo
class AlumnoController
{
    // Atributo con el motor de plantillas del microframework
    protected $view;

    // Constructor. Únicamente instancia un objeto View y lo asigna al atributo
    function __construct()
    {
        //Creamos una instancia de nuestro mini motor de plantillas
        $this->view = new View();
    }

    // Método del controlador para listar los items almacenados
    public function listar()
    {
        //Incluye el modelo que corresponde
        require 'models/AlumnoModel.php';

        //Creamos una instancia de nuestro "modelo"
        $alumnos = new AlumnoModel();

        //Le pedimos al modelo todos los items
        $listado = $alumnos->getAll();

        //Pasamos a la vista toda la información que se desea representar
        $data['alumnos'] = $listado;

        // Finalmente presentamos nuestra plantilla 
        // Llamamos al método "show" de la clase View, que es el motor de plantillas
        // Genera la vista de respuesta a partir de la plantilla y de los datos
        $this->view->show("listarView.php", $data);
    }


    public function index()
    {
        
        //Incluye el modelo que corresponde
        require 'models/AlumnoModel.php';

        //Creamos una instancia de nuestro "modelo"
        $alumnos = new AlumnoModel();

        //Le pedimos al modelo todos los items
        $listado = $alumnos->getAll();

        //Pasamos a la vista toda la información que se desea representar
        $data['alumnos'] = $listado;

        // Finalmente presentamos nuestra plantilla 
        // Llamamos al método "show" de la clase View, que es el motor de plantillas
        // Genera la vista de respuesta a partir de la plantilla y de los datos
        $this->view->show("listarView.php", $data);

    }

    // Método del controlador para crear un nuevo item
    public function nuevo()
    {
        require 'models/AlumnoModel.php';
        $alumno = new AlumnoModel();

        $errores = array();

        // Si recibe por GET o POST el objeto y lo guarda en la BG
        if (isset($_REQUEST['submit'])) {
            if (!isset($_REQUEST['alu_nombre']) || empty($_REQUEST['alu_nombre']) || !isset($_REQUEST['alu_empresa']) || empty($_REQUEST['alu_empresa'])||!isset($_REQUEST['alu_apto'])  )
                $errores['alumno'] = "* Alumno: Error";
            if (empty($errores)) {
                $alumno->setNombre(strtoupper($_REQUEST['alu_nombre']));
                $alumno->setEmpresa($_REQUEST['alu_empresa']);
                $alumno->setApto($_REQUEST['alu_apto']);
                $alumno->save();

                // Finalmente llama al método listar para que devuelva vista con listado
                header("Location: index.php?controlador=alumno&accion=listar");
            }
        }

        // Si no recibe el item para añadir, devuelve la vista para añadir un nuevo item
        $this->view->show("nuevoView.php", array('errores' => $errores));



    }

    // Método que procesa la petición para editar un item
    public function editar()
    {

        require 'models/AlumnoModel.php';
        $alumnos = new AlumnoModel();

        // Recuperar el item con el código recibido
        $alumno = $alumnos->getById($_REQUEST['alu_id']);

        if ($alumno == null) {
            $this->view->show("errorView.php", array('error' => 'No existe id de alumno'));
        }

        $errores = array();

        // Si se ha pulsado el botón de actualizar
        if (isset($_REQUEST['submit'])) {

            if (!isset($_REQUEST['alu_nombre']) || empty($_REQUEST['alu_nombre']))
                $errores['alumno'] = "* Alumno: Error";

            if (empty($errores)) {
                // Cambia el valor del item y lo guarda en BD
                $alumno->setNombre(strtoupper($_REQUEST['alu_nombre']));
                $alumno->setEmpresa($_REQUEST['alu_empresa']);
                $alumno->setApto($_REQUEST['alu_apto']);
                $alumno->save();

                // Reenvía a la aplicación a la lista de items
                header("Location: index.php?controlador=alumno&accion=listar");
            }
        }

        // Si no se ha pulsado el botón de actualizar se carga la vista para editar el item
        $this->view->show("editarView.php", array('alumno' => $alumno, 'errores' => $errores));



    }

    // Método para borrar un item 
    public function borrar()
    {
        //Incluye el modelo que corresponde
        require_once 'models/AlumnoModel.php';

        //Creamos una instancia de nuestro "modelo"
        $alumnos = new AlumnoModel();

        // Recupera el item con el código recibido por GET o por POST
        $alumno = $alumnos->getById($_REQUEST['alu_id']);

        if ($alumno == null) {
            $this->view->show("errorView.php", array('error' => 'No existe id de alumno'));
        } else {
            // Si existe lo elimina de la base de datos y vuelve al inicio de la aplicación
            $alumno->delete();
            header("Location: index.php");
        }
    }

}
?>