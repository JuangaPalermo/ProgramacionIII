<?php

include_once "empleadoController.php";

class empleadoRouter{

    public static function empleadoRouter ($app) {

        $app->group('/empleado', function() {
    
            $this->get('/', \empleadoController::class . ':ListarTodos'); //ok
         
            $this->get('/{id}', \empleadoController::class . ':TraerUnoPorID'); //ok
        
            $this->post('/', \empleadoController::class . ':CargarUno'); //ok
        });
        

        return $app;
    }
}