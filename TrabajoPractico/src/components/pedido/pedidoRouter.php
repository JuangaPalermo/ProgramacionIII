<?php

require_once 'pedidoController.php';

class pedidoRouter {

    public static function pedidoRouter($app) {
    
        $app->group('/pedido', function() {
    
            $this->get('/', \pedidoController::class . ':ListarTodos'); //ok
         
            $this->get('/{id}', \pedidoController::class . ':TraerUnoPorID'); //ok
        
            $this->post('/', \pedidoController::class . ':CargarUno'); //ok
        });

        return $app;
    }
}