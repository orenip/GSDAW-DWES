<?php
// Controlador para el modelo ItemModel (puede haber más controladores en la aplicación)
// Un controlador no tiene porque estar asociado a un objeto del modelo
class PartidosController {
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
        require 'models/PartidosModel.php';

        //Creamos una instancia de nuestro "modelo"
        $partidos = new PartidosModel();

        //Le pedimos al modelo todos los items
        $listado = $partidos->getAll();

        //Pasamos a la vista toda la información que se desea representar
        $data['partidos'] = $listado;

        // Finalmente presentamos nuestra plantilla 
        // Llamamos al método "show" de la clase View, que es el motor de plantillas
        // Genera la vista de respuesta a partir de la plantilla y de los datos
        $this->view->show("PartidosListarView.php", $data);
    }
   
    // Método del controlador para crear un nuevo item
    public function nuevo() {
        require 'models/PartidosModel.php';
        $partidos = new PartidosModel();

        $errores = array();

        // Si recibe por GET o POST el objeto y lo guarda en la BG
        if (isset($_REQUEST['submit'])) {
            // Comprobamos si se ha recibido el código
            if (!isset($_REQUEST['COD_PARTIDO']) || empty($_REQUEST['COD_PARTIDO']))
                $errores['COD_PARTIDO'] = "* Codigo: debes indicar un código.";

            // Comprobamos si se ha recibido el nombre
            if (!isset($_REQUEST['FECHA']) || empty($_REQUEST['FECHA']))
                $errores['FECHA'] = "* FECHA: debes indicar una FECHA.";

            if (!isset($_REQUEST['COD_EQUIPO1']) || empty($_REQUEST['COD_EQUIPO1']))
                $errores['COD_EQUIPO1'] = "* COD_EQUIPO1: debes indicar un COD_EQUIPO1.";
        
            if (!isset($_REQUEST['COD_EQUIPO2']) || empty($_REQUEST['COD_EQUIPO2']))
                $errores['COD_EQUIPO2'] = "* COD_EQUIPO2: debes indicar un COD_EQUIPO2.";
            
            if (!isset($_REQUEST['PUNTOS_EQUIPO1']) || empty($_REQUEST['PUNTOS_EQUIPO1']))
                $errores['PUNTOS_EQUIPO1'] = "* PUNTOS_EQUIPO1: debes indicar un PUNTOS_EQUIPO1.";

            if (!isset($_REQUEST['PUNTOS_EQUIPO2']) || empty($_REQUEST['PUNTOS_EQUIPO2']))
                $errores['PUNTOS_EQUIPO2'] = "* PUNTOS_EQUIPO2: debes indicar una PUNTOS_EQUIPO2.";

            // Si no hay errores actualizamos en la BD
            if (empty($errores)) {
                $partidos->setCOD_PARTIDO($_REQUEST['COD_PARTIDO']);
                $partidos->setFECHA($_REQUEST['FECHA']);
                $partidos->setCOD_EQUIPO1($_REQUEST['COD_EQUIPO1']);
                $partidos->setCOD_EQUIPO2($_REQUEST['COD_EQUIPO2']);
                $partidos->setPUNTOS_EQUIPO1($_REQUEST['PUNTOS_EQUIPO1']);
                $partidos->setPUNTOS_EQUIPO2($_REQUEST['PUNTOS_EQUIPO2']);
                $partidos->save();

                // Finalmente llama al método listar para que devuelva vista con listado
                header("Location: index.php?controlador=Partidos&accion=listar");
            }
        }

        // Si no recibe el item para añadir, devuelve la vista para añadir un nuevo item
        $this->view->show("PartidosNuevoView.php", array('errores' => $errores));



    }

    // Método que procesa la petición para editar un item
    public function editar() {

        require 'models/PartidosModel.php';
        $partidos = new PartidosModel();

        // Recuperar el item con el código recibido
        $partido = $partidos->getById($_REQUEST['COD_PARTIDO']);

        if ($partido == null) {
            $this->view->show("errorView.php", array('error' => 'No existe codigo'));
        }

        $errores = array();

        // Si se ha pulsado el botón de actualizar
        if (isset($_REQUEST['submit'])) {

            // Comprobamos si se ha recibido el nombre
            if (!isset($_REQUEST['COD_PARTIDO']) || empty($_REQUEST['COD_PARTIDO']))
            $errores['COD_PARTIDO'] = "* COD_PARTIDO: debes indicar una FECHA.";

            if (!isset($_REQUEST['FECHA']) || empty($_REQUEST['FECHA']))
                $errores['FECHA'] = "* FECHA: debes indicar una FECHA.";

            if (!isset($_REQUEST['COD_EQUIPO1']) || empty($_REQUEST['COD_EQUIPO1']))
                $errores['COD_EQUIPO1'] = "* COD_EQUIPO1: debes indicar un COD_EQUIPO1.";
        
            if (!isset($_REQUEST['COD_EQUIPO2']) || empty($_REQUEST['COD_EQUIPO2']))
                $errores['COD_EQUIPO2'] = "* COD_EQUIPO2: debes indicar un COD_EQUIPO2.";
            
            if (!isset($_REQUEST['PUNTOS_EQUIPO1']) || empty($_REQUEST['PUNTOS_EQUIPO1']))
                $errores['PUNTOS_EQUIPO1'] = "* PUNTOS_EQUIPO1: debes indicar un PUNTOS_EQUIPO1.";

            if (!isset($_REQUEST['PUNTOS_EQUIPO2']) || empty($_REQUEST['PUNTOS_EQUIPO2']))
                $errores['PUNTOS_EQUIPO2'] = "* PUNTOS_EQUIPO2: debes indicar una PUNTOS_EQUIPO2.";

            // Si no hay errores actualizamos en la BD
            if (empty($errores)) {
                $partidos->setCOD_PARTIDO($_REQUEST['COD_PARTIDO']);
                $partidos->setFECHA($_REQUEST['FECHA']);
                $partidos->setCOD_EQUIPO1($_REQUEST['COD_EQUIPO1']);
                $partidos->setCOD_EQUIPO2($_REQUEST['COD_EQUIPO2']);
                $partidos->setPUNTOS_EQUIPO1($_REQUEST['PUNTOS_EQUIPO1']);
                $partidos->setPUNTOS_EQUIPO2($_REQUEST['PUNTOS_EQUIPO2']);
                $partidos->save();

                // Reenvía a la aplicación a la lista de partidos
                header("Location: index.php?controlador=Partidos&accion=listar");
            }
        }

        // Si no se ha pulsado el botón de actualizar se carga la vista para editar el partido
        $this->view->show("PartidosEditarView.php", array('partido' => $partido, 'errores' => $errores));



    }

    // Método para borrar un partido 
    public function borrar() {
        //Incluye el modelo que corresponde
        require_once 'models/PartidosModel.php';

        //Creamos una instancia de nuestro "modelo"
        $partidos = new PartidosModel();

        // Recupera el item con el código recibido por GET o por POST
        $partido = $partidos->getById($_REQUEST['COD_PARTIDO']);

        if ($partido == null) {
            $this->view->show("errorView.php", array('error' => 'No existe codigo'));
        } else {
            // Si existe lo elimina de la base de datos y vuelve al inicio de la aplicación
            $partido->delete();
            header("Location: index.php");
        }
    }

}
?>