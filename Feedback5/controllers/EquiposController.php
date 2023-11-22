<?php
// Controlador para el modelo ItemModel (puede haber más controladores en la aplicación)
// Un controlador no tiene porque estar asociado a un objeto del modelo
class EquiposController {
    // Atributo con el motor de plantillas del microframework
    protected $view;

    // Constructor. Únicamente instancia un objeto View y lo asigna al atributo
    function __construct() {
        //Creamos una instancia de nuestro mini motor de plantillas
        $this->view = new View();
    }

    // Método del controlador para listar los items almacenados
    public function listar() {
        //Incluye el modelo que corresponde
        require 'models/EquiposModel.php';

        //Creamos una instancia de nuestro "modelo"
        $equipos = new EquiposModel();

        //Le pedimos al modelo todos los items
        $listado = $equipos->getAll();

        //Pasamos a la vista toda la información que se desea representar
        $data['equipos'] = $listado;

        // Finalmente presentamos nuestra plantilla 
        // Llamamos al método "show" de la clase View, que es el motor de plantillas
        // Genera la vista de respuesta a partir de la plantilla y de los datos
        $this->view->show("EquiposListarView.php", $data);
    }

    // Método del controlador para crear un nuevo item
    public function nuevo() {
        require 'models/EquiposModel.php';
        $equipos = new EquiposModel();

        $errores = array();

        // Si recibe por GET o POST el objeto y lo guarda en la BG
        if (isset($_REQUEST['submit'])) {
            // Comprobamos si se ha recibido el código
            if (!isset($_REQUEST['COD_EQUIPO']) || empty($_REQUEST['COD_EQUIPO']))
                $errores['COD_EQUIPO'] = "* Codigo: debes indicar un código.";

            // Comprobamos si se ha recibido el nombre
            if (!isset($_REQUEST['NOMBRE_EQUIPO']) || empty($_REQUEST['NOMBRE_EQUIPO']))
                $errores['NOMBRE_EQUIPO'] = "* NOMBRE_EQUIPO: debes indicar un NOMBRE_EQUIPO.";

            if (!isset($_REQUEST['PRESUPUESTO']) || empty($_REQUEST['PRESUPUESTO']))
                $errores['PRESUPUESTO'] = "* PRESUPUESTO: debes indicar un PRESUPUESTO.";
        
            if (!isset($_REQUEST['FECHA_FUNDACION']) || empty($_REQUEST['FECHA_FUNDACION']))
                $errores['FECHA_FUNDACION'] = "* FECHA_FUNDACION: debes indicar una FECHA_FUNDACION.";
            
            if (!isset($_REQUEST['ZONA']) || empty($_REQUEST['ZONA']))
                $errores['ZONA'] = "* ZONA: debes indicar una ZONA.";

            if (!isset($_REQUEST['TITULOS']) || empty($_REQUEST['TITULOS']))
                $errores['TITULOS'] = "* TITULOS: debes indicar una TITULOS.";

            // Si no hay errores actualizamos en la BD
            if (empty($errores)) {
                $equipos->setCOD_EQUIPO($_REQUEST['COD_EQUIPO']);
                $equipos->setNOMBRE_EQUIPO($_REQUEST['NOMBRE_EQUIPO']);
                $equipos->setPRESUPUESTO($_REQUEST['PRESUPUESTO']);
                $equipos->setFECHA_FUNDACION($_REQUEST['FECHA_FUNDACION']);
                $equipos->setZONA($_REQUEST['ZONA']);
                $equipos->setTITULOS($_REQUEST['TITULOS']);
                $equipos->save();

                // Finalmente llama al método listar para que devuelva vista con listado
                header("Location: index.php?controlador=Equipos&accion=listar");
            }
        }

        // Si no recibe el item para añadir, devuelve la vista para añadir un nuevo item
        $this->view->show("EquiposNuevoView.php", array('errores' => $errores));



    }

    // Método que procesa la petición para editar un item
    public function editar() {

        require 'models/EquiposModel.php';
        $equipos = new EquiposModel();

        // Recuperar el item con el código recibido
        $equipo = $equipos->getById($_REQUEST['COD_EQUIPO']);

        if ($equipo == null) {
            $this->view->show("errorView.php", array('error' => 'No existe codigo'));
        }

        $errores = array();

        // Si se ha pulsado el botón de actualizar
        if (isset($_REQUEST['submit'])) {

            // Comprobamos si se ha recibido el nombre
            if (!isset($_REQUEST['NOMBRE_EQUIPO']) || empty($_REQUEST['NOMBRE_EQUIPO']))
            $errores['NOMBRE_EQUIPO'] = "* NOMBRE_EQUIPO: debes indicar un NOMBRE_EQUIPO.";

            if (!isset($_REQUEST['PRESUPUESTO']) || empty($_REQUEST['PRESUPUESTO']))
                $errores['PRESUPUESTO'] = "* PRESUPUESTO: debes indicar un PRESUPUESTO.";
        
            if (!isset($_REQUEST['FECHA_FUNDACION']) || empty($_REQUEST['FECHA_FUNDACION']))
                $errores['FECHA_FUNDACION'] = "* FECHA_FUNDACION: debes indicar una FECHA_FUNDACION.";
            
            if (!isset($_REQUEST['ZONA']) || empty($_REQUEST['ZONA']))
                $errores['ZONA'] = "* ZONA: debes indicar una ZONA.";

            if (!isset($_REQUEST['TITULOS']) || empty($_REQUEST['TITULOS']))
                $errores['TITULOS'] = "* TITULOS: debes indicar una TITULOS.";

            // Si no hay errores actualizamos en la BD
            if (empty($errores)) {
                // Cambia el valor del item y lo guarda en BD
                $equipos->setCOD_EQUIPO($_REQUEST['COD_EQUIPO']);
                $equipos->setNOMBRE_EQUIPO($_REQUEST['NOMBRE_EQUIPO']);
                $equipos->setPRESUPUESTO($_REQUEST['PRESUPUESTO']);
                $equipos->setFECHA_FUNDACION($_REQUEST['FECHA_FUNDACION']);
                $equipos->setZONA($_REQUEST['ZONA']);
                $equipos->setTITULOS($_REQUEST['TITULOS']);
                $equipos->save();

                // Reenvía a la aplicación a la lista de items
                header("Location: index.php?controlador=Partidos&accion=listar");
            }
        }

        // Si no se ha pulsado el botón de actualizar se carga la vista para editar el item
        $this->view->show("EquiposEditarView.php", array('equipo' => $equipo, 'errores' => $errores));



    }

    // Método para borrar un item 
    public function borrar() {
        //Incluye el modelo que corresponde
        require_once 'models/EquiposModel.php';

        //Creamos una instancia de nuestro "modelo"
        $equipos = new EquiposModel();

        // Recupera el item con el código recibido por GET o por POST
        $equipo = $equipos->getById($_REQUEST['COD_EQUIPO']);

        if ($equipo == null) {
            $this->view->show("errorView.php", array('error' => 'No existe codigo'));
        } else {
            // Si existe lo elimina de la base de datos y vuelve al inicio de la aplicación
            $equipo->delete();
            header("Location: index.php?controlador=Equipos&accion=listar");
        }
    }

}
?>