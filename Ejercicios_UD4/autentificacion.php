<?php
// En primer lugar recuperamos la información de la sesión
session_start();

// Si el usuario no se ha autenticado le indicamos que 
if (!isset($_SESSION['usuario_app'])) {
    die("Error - debe <a href='index.php'>identificarse</a>.<br/>");
}
?>