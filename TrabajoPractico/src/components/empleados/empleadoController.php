<?php

include_once 'empleado.php';
include_once 'validators\altaEmpleadoValidator.php';
include_once 'validators\traerUnoPorIDValidator.php';
include_once 'controllers\empleadoAlta.php';
include_once 'controllers\empleadoListar.php';
include_once 'controllers\empleadoTraerPorID.php';

class empleadoController extends empleado{

    public function CargarUno($request, $response, $args){
        $ArrayDeParametros = $request->getParsedBody();
        $nombre= $ArrayDeParametros['nombre'];
        $apellido= $ArrayDeParametros['apellido'];
        $puesto= $ArrayDeParametros['puesto'];

        $miEmpleado = new Empleado();
        $miEmpleado->setNombre($nombre);
        $miEmpleado->setApellido($apellido);
        $miEmpleado->setPuesto($puesto);

        if(altaEmpleadoValidator::validarParametros($miEmpleado))
        {
            $miEmpleado->setId(empleadoAlta::InsertarEmpleadoParametros($miEmpleado));
            
            $response->getBody()->write("Empleado guardado.");

            return $response;
        }
        else
        {
            $response->getBody()->write("Error en los parametros obtenidos.");

            return $response;
        }
    }

    public function ListarTodos($request, $response, $args) {
        $misEmpleados=empleadoListar::TraerTodosLosEmpleados();
        $newResponse = $response->withJson($misEmpleados,200);
        return $newResponse;
    }

    public function TraerUnoPorID($request, $response, $args) {
        $id = $args["id"];

        if(TraerUnoPorIDValidator::validarID($id))
        {
            $miCliente=empleadoTraerPorID::TraerEmpleadoPorID($id);
            $newResponse = $response->withJson($miCliente, 200);
            return $newResponse;
        }
        else
        {
            $response->getBody()->write("Error en los parametros obtenidos.");

            return $response;
        }
    }
}
