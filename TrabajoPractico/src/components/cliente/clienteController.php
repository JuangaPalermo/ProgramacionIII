<?php

include_once 'cliente.php';
include_once 'controllers\clienteAlta.php';
include_once 'controllers\clienteListar.php';
include_once 'controllers\clienteTraerPorID.php';

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

        //imagenes
            // $archivos = $request->getUploadedFiles();
            // $destino="./fotos/";
            // //var_dump($archivos);
            // //var_dump($archivos['foto']);

            // $nombreAnterior=$archivos['foto']->getClientFilename();
            // $extension= explode(".", $nombreAnterior)  ;
            // //var_dump($nombreAnterior);
            // $extension=array_reverse($extension);

            // $archivos['foto']->moveTo($destino.$titulo.".".$extension[0]);
            
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