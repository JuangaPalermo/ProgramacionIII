<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


require_once './src/config/vendor/autoload.php';
require_once './src/utils/AccesoDatos.php';
require_once './src/components/cliente/clienteRouter.php';
require_once './src/components/cliente/clienteController.php';
require_once './src/components/empleados/empleadoRouter.php';
require_once './src/components/empleados/empleadoController.php';
require_once './src/components/mesa/mesaRouter.php';
require_once './src/components/mesa/mesaController.php';



$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

/*
¡La primera línea es la más importante! A su vez en el modo de 
desarrollo para obtener información sobre los errores
 (sin él, Slim por lo menos registrar los errores por lo que si está utilizando
  el construido en PHP webserver, entonces usted verá en la salida de la consola 
  que es útil).

  La segunda línea permite al servidor web establecer el encabezado Content-Length, 
  lo que hace que Slim se comporte de manera más predecible.
*/

$app = new \Slim\App(["settings" => $config]);

$app->group('/cliente', function () {
 
  $this->get('/', \clienteController::class . ':ListarTodos'); //ok
 
  $this->get('/{id}', \clienteController::class . ':TraerUno'); //ok

  $this->post('/', \clienteController::class . ':CargarUno'); //ok
     
});

$app->group('/empleado', function() {
    
    $this->get('/', \empleadoController::class . ':ListarTodos'); //ok
 
    $this->get('/{id}', \empleadoController::class . ':TraerUnoPorID'); //ok

    $this->post('/', \empleadoController::class . ':CargarUno'); //ok
});

$app->group('/mesa', function() {

    $this->get('/', \mesaController::class . ':ListarTodos'); //ok
 
    $this->get('/{id}', \mesaController::class . ':TraerUnoPorID'); //ok

    $this->post('/', \mesaController::class . ':CargarUno'); //ok
});

$app->run();

?>