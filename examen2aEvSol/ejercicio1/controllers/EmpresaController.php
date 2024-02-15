<?php
// Controlador para el modelo ItemModel (puede haber más controladores en la aplicación)
// Un controlador no tiene porque estar asociado a un objeto del modelo
class EmpresaController
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
        require 'models/EmpresaModel.php';

        //Creamos una instancia de nuestro "modelo"
        $empresas = new EmpresaModel();

        //Le pedimos al modelo todos los items
        $listado = $empresas->getAll();

        //Pasamos a la vista toda la información que se desea representar
        $data['empresas'] = $listado;

        // Finalmente presentamos nuestra plantilla 
        // Llamamos al método "show" de la clase View, que es el motor de plantillas
        // Genera la vista de respuesta a partir de la plantilla y de los datos
        $this->view->show("listarEmpresaView.php", $data);
    }


    public function index()
    {
        //Incluye el modelo que corresponde
        require 'models/EmpresaModel.php';

        //Creamos una instancia de nuestro "modelo"
        $empresas = new EmpresaModel();

        //Le pedimos al modelo todos los items
        $listado = $empresas->getAll();

        //Pasamos a la vista toda la información que se desea representar
        $data['empresas'] = $listado;

        // Finalmente presentamos nuestra plantilla 
        // Llamamos al método "show" de la clase View, que es el motor de plantillas
        // Genera la vista de respuesta a partir de la plantilla y de los datos
        $this->view->show("listarEmpresaView.php", $data);
    }

    // Método del controlador para crear un nuevo item
    public function nuevo()
    {
        require 'models/EmpresaModel.php';
        $empresa = new EmpresaModel();

        $errores = array();

        // Si recibe por GET o POST el objeto y lo guarda en la BG
        if (isset($_REQUEST['submit'])) {
            if (!isset($_REQUEST['emp_nombre']) || empty($_REQUEST['emp_nombre']))
                $errores['emresa'] = "* Empresa: Error";
            if (empty($errores)) {
                $empresa->setNombre($_REQUEST['emp_nombre']);
                $empresa->save();

                // Finalmente llama al método listar para que devuelva vista con listado
                header("Location: index.php?controlador=empresa&accion=listar");
            }
        }

        // Si no recibe el item para añadir, devuelve la vista para añadir un nuevo item
        $this->view->show("nuevoEmpresaView.php", array('errores' => $errores));



    }

    // Método que procesa la petición para editar un item
    public function editar()
    {

        require 'models/EmpresaModel.php';
        $empresas = new EmpresaModel();

        // Recuperar el item con el código recibido
        $empresa = $empresas->getById($_REQUEST['emp_id']);

        if ($empresa == null) {
            $this->view->show("errorView.php", array('error' => 'No existe el id de empresa'));
        }

        $errores = array();

        // Si se ha pulsado el botón de actualizar
        if (isset($_REQUEST['submit'])) {

            if (!isset($_REQUEST['emp_nombre']) || empty($_REQUEST['emp_nombre']))
                $errores['empresa'] = "* Empresa: Error";

            if (empty($errores)) {
                // Cambia el valor del item y lo guarda en BD
                $empresa->setNombre($_REQUEST['emp_nombre']);
                $empresa->save();

                // Reenvía a la aplicación a la lista de items
                header("Location: index.php?controlador=empresa&accion=listar");
            }
        }

        // Si no se ha pulsado el botón de actualizar se carga la vista para editar el item
        $this->view->show("editarEmpresaView.php", array('empresa' => $empresa, 'errores' => $errores));



    }

    // Método para borrar un item 
    public function borrar()
    {
        //Incluye el modelo que corresponde
        require_once 'models/EmpresaModel.php';

        //Creamos una instancia de nuestro "modelo"
        $empresas = new EmpresaModel();

        // Recupera el item con el código recibido por GET o por POST
        $empresa = $empresas->getById($_REQUEST['emp_id']);

        if ($empresa == null) {
            $this->view->show("errorView.php", array('error' => 'No existe id de empresa'));
        } else {
            // Si existe lo elimina de la base de datos y vuelve al inicio de la aplicación
            $empresa->delete();
            header("Location: index.php");
        }
    }


    public function calificar()
    {
        

        //recuperamos el modelo de alumno
        require_once 'models/AlumnoModel.php';

        $alumno= new AlumnoModel();
        
        $alumno->alumnosAsociados($_REQUEST['emp_id']);

        header("Location: index.php");






    }

}
?>