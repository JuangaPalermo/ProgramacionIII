<?php

require_once 'mesaController.php';

class mesaRouter {

    public static function mesaRouter($app) {
    
        $app->group('/mesa', function() {
    
            $this->get('/', \mesaController::class . ':ListarTodos'); //ok
         
            $this->get('/{id}', \mesaController::class . ':TraerUnoPorID'); //ok
        
            $this->post('/', \mesaController::class . ':CargarUno'); //ok
        });

        return $app;
    }
}