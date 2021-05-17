<?php

include_once 'producto.php';
include_once 'DAOs\productoAlta.php';
include_once 'DAOs\productoListar.php';
include_once 'DAOs\productoTraerPorID.php';
include_once 'validators\productoAltaValidator.php';
include_once 'validators\productoTraerPorIDValidator.php';

class productoController extends Producto{
    
    public function CargarUno($request, $response, $args){
        $ArrayDeParametros = $request->getParsedBody();
        $nombre= $ArrayDeParametros['nombre'];
        $precio= $ArrayDeParametros['precio'];
        $servidoPor= $ArrayDeParametros['servidoPor'];

        $miProducto = new Producto();
        $miProducto->setNombre($nombre);
        $miProducto->setPrecio($precio);
        $miProducto->setServidoPor($servidoPor);

        if(productoAltaValidator::validarParametros($miProducto))
        {
            $miProducto->setIdProducto(productoAlta::InsertarProductoParametros($miProducto));
            
            $response->getBody()->write("Producto guardado.");
        }
        else
        {
            $response->getBody()->write("Error en los parametros obtenidos.");

            return $response;
        }

        return $response;

    }

    public function ListarTodos($request, $response, $args) {
        $misProductos=productoListar::TraerTodosLosProductos();
        $newResponse = $response->withJson($misProductos,200);
        return $newResponse;
    }

    public function TraerUnoPorID($request, $response, $args) {
        $idProducto = $args["idProducto"];

        if(productoTraerPorIDValidator::validarID($idProducto))
        {
            $miProducto=productoTraerPorID::TraerProductoPorID($idProducto);
            $newResponse = $response->withJson($miProducto, 200);
            return $newResponse;
        }
        else
        {
            $response->getBody()->write("Error en los parametros obtenidos.");

            return $response;
        }
    }
}