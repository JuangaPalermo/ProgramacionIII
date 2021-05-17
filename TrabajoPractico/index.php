<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


require_once './src/config/vendor/autoload.php';
require_once './src/utils/AccesoDatos.php';
require_once './src/components/cliente/clienteRouter.php';
require_once './src/components/empleado/empleadoRouter.php';
require_once './src/components/mesa/mesaRouter.php';
require_once './src/components/producto/productoRouter.php';
require_once './src/components/pedido/pedidoRouter.php';

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$app = new \Slim\App(["settings" => $config]);

clienteRouter::clienteRouter($app);
empleadoRouter::empleadoRouter($app);
mesaRouter::mesaRouter($app);
productoRouter::productoRouter($app);
pedidoRouter::pedidoRouter($app);

$app->run();

?>