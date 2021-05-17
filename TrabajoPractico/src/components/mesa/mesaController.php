<?php

include_once 'mesa.php';
include_once 'DAOs\mesaAlta.php';
include_once 'DAOs\mesaListar.php';
include_once 'DAOs\mesaTraerPorID.php';
include_once 'validators\TraerMesaPorIDValidator.php';

class mesaController extends mesa{

    public function CargarUno($request, $response, $args){
        $ArrayDeParametros = $request->getParsedBody();
        $estado= $ArrayDeParametros['estado'];

        $miMesa = new Mesa();
        $miMesa->setEstado($estado);
        $miMesa->setId(mesaAlta::InsertarMesaParametros($miMesa));
        
        $response->getBody()->write("Mesa guardada.");

        return $response;

    }

    public function ListarTodos($request, $response, $args) {
        $misMesas=mesaListar::TraerTodasLasMesas();
        $newResponse = $response->withJson($misMesas,200);
        return $newResponse;
    }

    public function TraerUnoPorID($request, $response, $args) {
        $id = $args["id"];

        if(TraerMesaPorIDValidator::validarID($id))
        {
            $miMesa=mesaTraerPorID::TraerMesaPorID($id);
            $newResponse = $response->withJson($miMesa, 200);
            return $newResponse;
        }
        else
        {
            $response->getBody()->write("Error en los parametros obtenidos.");

            return $response;
        }
    }
}
