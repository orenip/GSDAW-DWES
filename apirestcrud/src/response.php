<?php
/**
 * Clase estática que se utiliza para generar la respuesta que se envía al cliente que hace uso de la API REST.
 */
class Response
{
	public static function result($code, $response){//Método estático que se utiliza para generar la respuesta que se envía al cliente que hace uso de la API REST.

		header('Content-type: application/json');//Se indica que el tipo de contenido que se va a enviar es JSON
		http_response_code($code);//Se indica el código de respuesta

		echo json_encode($response);//Se codifica el array $response a JSON y se envía al cliente
	}
}

?>