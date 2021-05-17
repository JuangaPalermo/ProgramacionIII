<?php

require_once 'productoController.php';

class productoRouter {

    public static function productoRouter($app) {
    
        $app->group('/producto', function() {
    
            $this->get('/', \productoController::class . ':ListarTodos'); //ok
         
            $this->get('/{idProducto}', \productoController::class . ':TraerUnoPorID'); //ok
        
            $this->post('/', \productoController::class . ':CargarUno'); //ok
        });

        return $app;
    }
}