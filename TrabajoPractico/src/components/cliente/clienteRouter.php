<?php
require_once "clienteController.php";

class clienteRouter {


    public static function clienteRouter ($app){

        $app->group('/cliente', function () {
     
            $this->get('/', \clienteController::class . ':ListarTodos'); //ok
           
            $this->get('/{id}', \clienteController::class . ':TraerUno'); //ok
          
            $this->post('/', \clienteController::class . ':CargarUno'); //ok
               
        });

        return $app;
    }

}