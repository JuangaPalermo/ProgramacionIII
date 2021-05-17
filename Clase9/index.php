<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


require_once './config/vendor/autoload.php';

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$app = new \Slim\App(["settings" => $config]);

//Esta es la funcion del MW
$VerificadorDeCredenciales = function ($request, $response, $next) {

    if($request->isGet())
    {
       $response->getBody()->write('<p>NO necesita credenciales para los get</p>');
       $response = $next($request, $response);
    }
    else
    {
      $response->getBody()->write('<p>verifico credenciales</p>');
      $bodyParams = $request->getParsedBody();
      $nombre=$bodyParams['nombre'];
      $perfil=$bodyParams['perfil'];
      if($perfil=="administrador")
      {
        $response->getBody()->write("<h3>Bienvenido $nombre </h3>");
        $response = $next($request, $response);
      }
      else
      {
        $response->getBody()->write('<p>no tenes habilitado el ingreso</p>');
      }  
    }  
    $response->getBody()->write('<p>vuelvo del verificador de credenciales</p>');
    return $response;  
};

//asigno la funcion al grupo
$app->group('/credenciales', function () {
 
    $this->get('[/]', function (Request $request, Response $response) {    
        $response->getBody()->write("GET => entre al GET");
        return $response;
    
    });
    $this->post('[/]', function (Request $request, Response $response) {    
        $response->getBody()->write("POST => entre al POST");
        return $response;
    
    });
     
})->add($VerificadorDeCredenciales);




$app->run();

?>