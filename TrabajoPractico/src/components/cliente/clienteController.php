<?php

include_once 'cliente.php';
include_once 'DAOs\clienteAlta.php';
include_once 'DAOs\clienteListar.php';
include_once 'DAOs\clienteTraerPorID.php';

class clienteController extends cliente
{
   
    public function CargarUno($request, $response, $args) {
        $ArrayDeParametros = $request->getParsedBody();
        $nombre= $ArrayDeParametros['nombre'];
        $apellido= $ArrayDeParametros['apellido'];
        $email= $ArrayDeParametros['email'];

        $miCliente = new cliente();
        $miCliente->setNombre($nombre);
        $miCliente->setApellido($apellido);
        $miCliente->setEmail($email);
        $miCliente->setId(clienteAlta::InsertarClienteParametros($miCliente));
            
        $response->getBody()->write("Cliente guardado.");

        return $response;
    }

    public function ListarTodos($request, $response, $args) {
        $misClientes=clienteListar::TraerTodosLosClientes();
        $newResponse = $response->withJson($misClientes,200);
        return $newResponse;
    }

    public function TraerUno($request, $response, $args) {
        $id = $args["id"];
        $miCliente=clienteTraerPorID::TraerClientePorID($id);
        $newResponse = $response->withJson($miCliente, 200);
        return $newResponse;
    }
}