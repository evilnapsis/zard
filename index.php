<?php
session_start();
// el archivo autoload inicializa todos lo archivos necesarios para que el framework funcione
include "app/autoload.php";

define("ROOT",dirname(__FILE__));

// cargamos el modulo iniciar.
$lb = new Lb();
$lb->display_errors = false;
$lb->loadModule("admin");

?>

