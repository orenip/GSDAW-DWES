<?php
/**
 *	Script que se usa en los endpoints para trabajar con registros de la tabla alumno
 *	La clase "alumno.class.php" es la clase del modelo
*/
require_once 'src/response.php';
require_once 'src/classes/alumno.class.php';


require_once 'src/classes/auth.class.php';

$auth = new Authentication();
$auth->verify();

$alumno = new Alumno();


/**
 * Se mira el tipo de petición que ha llegado a la API y dependiendo de ello se realiza una u otra accción
 */
switch ($_SERVER['REQUEST_METHOD']) {
	
	/**
	 * Si se recibe un POST, se comprueba si se han recibido parámetros y en caso afirmativo se usa el método insert() del modelo
	 */
	
	 case 'POST':
		$params = json_decode(file_get_contents('php://input'), true);

		if(!isset($params) || !isset($_GET['emp_id']) || empty($_GET['emp_id'])){
			$response = array(
				'result' => 'error',
				'details' => 'Error en la solicitud'
			);

			Response::result(400, $response);
			exit;
		}

        //recuperamos los alumnos que tienen ese id de empresa
        //recupero el emp_id y se lo mando como parámtro a la consulta
        $params1=array("alu_emp"=>$_GET['emp_id']);
        $resultados=$alumno->get($params1);
        

        //forzamos a que el valor apto sea igual a 1
        
        foreach($resultados as $resultado)
        {
            $params2=array("alu_apto"=> "1");
            $alumno->update($resultado[0],$params2);


        }
        
		$response = array(
			'result' => 'ok'
		);

		Response::result(200, $response);	
		break;
	
}
?>