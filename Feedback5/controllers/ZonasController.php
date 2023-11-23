<?php
// Controlador para el modelo ItemModel (puede haber más controladores en la aplicación)
// Un controlador no tiene porque estar asociado a un objeto del modelo
class ZonasController {
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
        require 'models/ZonasModel.php';

        //Creamos una instancia de nuestro "modelo"
        $zonas = new ZonasModel();

        //Le pedimos al modelo todos los items
        $listado = $zonas->getAll();

        //Pasamos a la vista toda la información que se desea representar
        $data['zonas'] = $listado;

        // Finalmente presentamos nuestra plantilla 
        // Llamamos al método "show" de la clase View, que es el motor de plantillas
        // Genera la vista de respuesta a partir de la plantilla y de los datos
        $this->view->show("ZonasListarView.php", $data);
    }

    // Método del controlador para crear un nuevo item
    public function nuevo() {
        require 'models/ZonasModel.php';
        $zonas = new ZonasModel();

        $errores = array();

        // Si recibe por GET o POST el objeto y lo guarda en la BG
        if (isset($_REQUEST['submit'])) {
            // Comprobamos si se ha recibido el código
            if (!isset($_REQUEST['COD_ZONA']) || empty($_REQUEST['COD_ZONA']))
                $errores['COD_ZONA'] = "* COD_ZONA: debes indicar un COD_ZONA.";

            // Comprobamos si se ha recibido el nombre
            if (!isset($_REQUEST['NOMBRE_ZONA']) || empty($_REQUEST['NOMBRE_ZONA']))
                $errores['NOMBRE_ZONA'] = "* NOMBRE_ZONA: debes indicar un NOMBRE_ZONA.";

            // Si no hay errores actualizamos en la BD
            if (empty($errores)) {
                $zonas->setCOD_ZONA($_REQUEST['COD_ZONA']);
                $zonas->setNOMBRE_ZONA($_REQUEST['NOMBRE_ZONA']);
                $zonas->save();

                // Finalmente llama al método listar para que devuelva vista con listado
                header("Location: index.php?controlador=Zonas&accion=listar");
            }
        }

        // Si no recibe el item para añadir, devuelve la vista para añadir un nuevo item
        $this->view->show("ZonasNuevoView.php", array('errores' => $errores));



    }

    // Método que procesa la petición para editar un item
    public function editar() {

        require 'models/ZonasModel.php';
        $zonas = new ZonasModel();

        // Recuperar el item con el código recibido
        $zona = $zonas->getById($_REQUEST['COD_ZONA']);

        if ($zona == null) {
            $this->view->show("errorView.php", array('error' => 'No existe codigo'));
        }

        $errores = array();

        // Si se ha pulsado el botón de actualizar
        if (isset($_REQUEST['submit'])) {

            // Comprobamos si se ha recibido el nombre
            if (!isset($_REQUEST['NOMBRE_ZONA']) || empty($_REQUEST['NOMBRE_ZONA']))
            $errores['NOMBRE_ZONA'] = "* NOMBRE_ZONA: debes indicar un NOMBRE_ZONA.";

            // Si no hay errores actualizamos en la BD
            if (empty($errores)) {
                // Cambia el valor del item y lo guarda en BD
                $zonas->setCOD_ZONA($_REQUEST['COD_ZONA']);
                $zonas->setNOMBRE_ZONA($_REQUEST['NOMBRE_ZONA']);
                $zonas->save();

                // Reenvía a la aplicación a la lista de items
                header("Location: index.php?controlador=Zonas&accion=listar");
            }
        }

        // Si no se ha pulsado el botón de actualizar se carga la vista para editar el item
        $this->view->show("ZonasEditarView.php", array('zona' => $zona, 'errores' => $errores));



    }

    // Método para borrar un item 
    public function borrar() {
        //Incluye el modelo que corresponde
        require_once 'models/ZonasModel.php';

        //Creamos una instancia de nuestro "modelo"
        $zonas = new ZonasModel();

        // Recupera el item con el código recibido por GET o por POST
        $zona = $zonas->getById($_REQUEST['COD_ZONA']);

        if ($zona == null) {
            $this->view->show("errorView.php", array('error' => 'No existe codigo'));
        } else {
            try {
                // Si existe lo elimina de la base de datos y vuelve al inicio de la aplicación
                $zona->delete();
                header("Location: index.php?controlador=Zonas&accion=listar");
            } catch (PDOException $e) {
                //Si tiene alguna llave foranea notificamos con un mensaje
                $this->view->show("errorView.php", array('error' => 'No se puede borrar el equipo porque tiene referencias en otra tabla.'));
            
            }
        }
    }

}
?>