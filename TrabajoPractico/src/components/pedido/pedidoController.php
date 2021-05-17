<?php

include_once 'pedido.php';
include_once 'src\components\mesa\mesaController.php';
include_once 'src\components\cliente\clienteController.php';
include_once 'src\components\producto\productoController.php';
include_once 'DAOs\pedidoAlta.php';
include_once 'DAOs\pedidoListar.php';
include_once 'DAOs\pedidoTraerPorID.php';

class pedidoController extends pedido{

    public function CargarUno($request, $response, $args){
        $ArrayDeParametros = $request->getParsedBody();
        
        //recibe los ID y crea las entidades que luego le pasa al insertar.
        $idMesa= $ArrayDeParametros['idMesa'];
        $idCliente= $ArrayDeParametros['idCliente'];
        $idProducto= $ArrayDeParametros['idProducto'];

        $miPedido = new Pedido();
        $miPedido->setIdPedido(Pedido::generateAlphanumeric());
        $miPedido->setIdMesa($idMesa);
        $miPedido->setIdCliente($idCliente);
        $miPedido->setIdProducto($idProducto);
        $miPedido->setEstado("pendiente");
        $miPedido->setFechaCreacion(date("Y-m-d"));
        $miMesa=mesaTraerPorID::TraerMesaPorID($idMesa);
        $miCliente=clienteTraerPorID::TraerClientePorID($idCliente);
        $miProducto=productoTraerPorID::TraerProductoPorID($idProducto);
        if($miMesa && $miCliente && $miProducto){

            pedidoAlta::InsertarPedidoParametros($miPedido, $miMesa, $miCliente, $miProducto);
            
            $response->getBody()->write("Pedido Generado");
        }else{
            $newResponse = $response->withJson("Error en los parametros obtenidos", 404);
            return $newResponse;
        }



        return $response;
    }

    public function ListarTodos($request, $response, $args) {
        $misPedidos=pedidoListar::TraerTodosLosPedidos();
        $newResponse = $response->withJson($misPedidos,200);
        return $newResponse;
    }

    public function TraerUnoPorID($request, $response, $args) {
        $id = $args["id"];

        $miPedido=pedidoTraerPorID::TraerPedidoPorID($id);
        $newResponse = $response->withJson($miPedido, 200);
        return $newResponse;
    }
}
