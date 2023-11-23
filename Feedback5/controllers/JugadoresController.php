<?php
// Controlador para el modelo ItemModel (puede haber más controladores en la aplicación)
// Un controlador no tiene porque estar asociado a un objeto del modelo
class JugadoresController {
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
        require 'models/JugadoresModel.php';

        //Creamos una instancia de nuestro "modelo"
        $jugadores = new JugadoresModel();

        //Le pedimos al modelo todos los items
        $listado = $jugadores->getAll();

        //Pasamos a la vista toda la información que se desea representar
        $data['jugadores'] = $listado;

        // Finalmente presentamos nuestra plantilla 
        // Llamamos al método "show" de la clase View, que es el motor de plantillas
        // Genera la vista de respuesta a partir de la plantilla y de los datos
        $this->view->show("JugadoresListarView.php", $data);
    }

    // Método del controlador para crear un nuevo item
    public function nuevo() {
        require 'models/JugadoresModel.php';
        $jugadores = new JugadoresModel();

        $errores = array();

        // Si recibe por GET o POST el objeto y lo guarda en la BG
        if (isset($_REQUEST['submit'])) {
            // Comprobamos si se ha recibido el código
            if (!isset($_REQUEST['COD_JUGADOR']) || empty($_REQUEST['COD_JUGADOR']))
                $errores['COD_JUGADOR'] = "* COD_JUGADOR: debes indicar un COD_JUGADOR.";

            // Comprobamos si se ha recibido el nombre
            if (!isset($_REQUEST['NOMBRE_JUGADOR']) || empty($_REQUEST['NOMBRE_JUGADOR']))
                $errores['NOMBRE_JUGADOR'] = "* NOMBRE_JUGADOR: debes indicar un NOMBRE_JUGADOR.";
        
            if (!isset($_REQUEST['FECHA_NACIMIENTO']) || empty($_REQUEST['FECHA_NACIMIENTO']))
                $errores['FECHA_NACIMIENTO'] = "* FECHA_NACIMIENTO: debes indicar una FECHA_NACIMIENTO.";
            
            if (!isset($_REQUEST['ESTATURA']) || empty($_REQUEST['ESTATURA']))
                $errores['ESTATURA'] = "* ESTATURA: debes indicar un ESTATURA.";

            if (!isset($_REQUEST['POSICION']) || empty($_REQUEST['POSICION']))
                $errores['POSICION'] = "* POSICION: debes indicar una POSICION.";

            if (!isset($_REQUEST['EQUIPO']) || empty($_REQUEST['EQUIPO']))
                $errores['EQUIPO'] = "* EQUIPO: debes indicar una EQUIPO.";

            // Si no hay errores actualizamos en la BD
            if (empty($errores)) {
                $jugadores->setCOD_JUGADOR($_REQUEST['COD_JUGADOR']);
                $jugadores->setNOMBRE_JUGADOR($_REQUEST['NOMBRE_JUGADOR']);
                $jugadores->setFECHA_NACIMIENTO($_REQUEST['FECHA_NACIMIENTO']);
                $jugadores->setESTATURA($_REQUEST['ESTATURA']);
                $jugadores->setPOSICION($_REQUEST['POSICION']);
                $jugadores->setEQUIPO($_REQUEST['EQUIPO']);
                $jugadores->save();

                // Finalmente llama al método listar para que devuelva vista con listado
                header("Location: index.php?controlador=Jugadores&accion=listar");
            }
        }

        // Si no recibe el item para añadir, devuelve la vista para añadir un nuevo item
        $this->view->show("JugadoresNuevoView.php", array('errores' => $errores));



    }

    // Método que procesa la petición para editar un item
    public function editar() {

        require 'models/JugadoresModel.php';
        $jugadores = new JugadoresModel();

        // Recuperar el item con el código recibido
        $jugador = $jugadores->getById($_REQUEST['COD_JUGADOR']);

        if ($jugador == null) {
            $this->view->show("errorView.php", array('error' => 'No existe codigo'));
        }

        $errores = array();

        // Si se ha pulsado el botón de actualizar
        if (isset($_REQUEST['submit'])) {

            // Comprobamos si se ha recibido el nombre
            if (!isset($_REQUEST['NOMBRE_JUGADOR']) || empty($_REQUEST['NOMBRE_JUGADOR']))
            $errores['NOMBRE_JUGADOR'] = "* NOMBRE_JUGADOR: debes indicar un NOMBRE_JUGADOR.";

            if (!isset($_REQUEST['FECHA_NACIMIENTO']) || empty($_REQUEST['FECHA_NACIMIENTO']))
                $errores['FECHA_NACIMIENTO'] = "* FECHA_NACIMIENTO: debes indicar un FECHA_NACIMIENTO.";
        
            if (!isset($_REQUEST['ESTATURA']) || empty($_REQUEST['ESTATURA']))
                $errores['ESTATURA'] = "* ESTATURA: debes indicar una FECHA_FUNDACION.";
            
            if (!isset($_REQUEST['POSICION']) || empty($_REQUEST['POSICION']))
                $errores['POSICION'] = "* POSICION: debes indicar una POSICION.";

            if (!isset($_REQUEST['EQUIPO']) || empty($_REQUEST['EQUIPO']))
                $errores['EQUIPO'] = "* EQUIPO: debes indicar una EQUIPO.";

            // Si no hay errores actualizamos en la BD
            if (empty($errores)) {
                // Cambia el valor del item y lo guarda en BD
                $jugadores->setCOD_JUGADOR($_REQUEST['COD_JUGADOR']);
                $jugadores->setNOMBRE_JUGADOR($_REQUEST['NOMBRE_JUGADOR']);
                $jugadores->setFECHA_NACIMIENTO($_REQUEST['FECHA_NACIMIENTO']);
                $jugadores->setESTATURA($_REQUEST['ESTATURA']);
                $jugadores->setPOSICION($_REQUEST['POSICION']);
                $jugadores->setEQUIPO($_REQUEST['EQUIPO']);
                $jugadores->save();

                // Reenvía a la aplicación a la lista de items
                header("Location: index.php?controlador=Jugadores&accion=listar");
            }
        }

        // Si no se ha pulsado el botón de actualizar se carga la vista para editar el item
        $this->view->show("JugadoresEditarView.php", array('jugador' => $jugador, 'errores' => $errores));



    }

    // Método para borrar un item 
    public function borrar() {
        //Incluye el modelo que corresponde
        require_once 'models/JugadoresModel.php';

        //Creamos una instancia de nuestro "modelo"
        $jugadores = new JugadoresModel();

        // Recupera el item con el código recibido por GET o por POST
        $jugador = $jugadores->getById($_REQUEST['COD_JUGADOR']);

        if ($jugador == null) {
            $this->view->show("errorView.php", array('error' => 'No existe codigo'));
        } else {
            // Si existe lo elimina de la base de datos y vuelve al inicio de la aplicación
            $jugador->delete();
            header("Location: index.php?controlador=Jugadores&accion=listar");
        }
    }

}
?>