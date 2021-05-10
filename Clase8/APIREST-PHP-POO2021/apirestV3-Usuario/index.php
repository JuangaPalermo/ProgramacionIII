<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once '../vendor/autoload.php';
require_once './clases/AccesoDatos.php';
require_once './clases/usuarioApi.php';


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

/*LLAMADA A METODOS DE INSTANCIA DE UNA CLASE*/
$app->group('/usuario', function () {
 
  $this->get('/', \usuarioApi::class . ':traerTodos'); //ok
 
  $this->get('/{id}', \usuarioApi::class . ':traerUno'); //ok

  $this->post('/', \usuarioApi::class . ':CargarUno'); //ok

  $this->post('/login/', \usuarioApi::class . ':LoginUsuario'); //

  $this->delete('/', \usuarioApi::class . ':BorrarUno'); //ok

  $this->put('/', \usuarioApi::class . ':ModificarUno'); //ok
     
});

$app->run();

?>