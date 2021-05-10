<?php

/*TIENE TODOS LOS METODOS DE LA CLASE CD E IMPLEMENTA APIUSABLE (O SEA QUE TIENE LAS FUNCIONALIDADES AHI DEFINIDAS)
  INTERNAMENTE ESTA HARA UN MONTON DE COSAS, PERO SIEMPRE LLAMANDO A LOS METODOS DE CD
*/

require_once 'usuario.php';
require_once 'IApiUsable.php';

class usuarioApi extends usuario implements IApiUsable
{
 	public function TraerUno($request, $response, $args) {
     	$id=$args['id'];
    	$elUsuario=usuario::TraerUnUsuario($id);
     	$newResponse = $response->withJson($elUsuario, 200);  
    	return $newResponse;
    }

     public function TraerTodos($request, $response, $args) {
      	$todosLosUsuarios=usuario::TraerTodoLosUsuarios();
     	$newResponse = $response->withJson($todosLosUsuarios, 200);  
    	return $newResponse;
    }

    public function CargarUno($request, $response, $args) {
     	$ArrayDeParametros = $request->getParsedBody();
        //var_dump($ArrayDeParametros);
        $nombre= $ArrayDeParametros['nombre'];
        $apellido= $ArrayDeParametros['apellido'];
        $mail= $ArrayDeParametros['mail'];
        $clave= $ArrayDeParametros['clave'];
        
        $miUsuario = new usuario();
        $miUsuario->nombre=$nombre;
        $miUsuario->apellido=$apellido;
        $miUsuario->mail=$mail;
        $miUsuario->clave=$clave;
        $miUsuario->InsertarElUsuarioParametros();

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
            
        $response->getBody()->write("se guardo el Usuario");

        return $response;
    }

    public function BorrarUno($request, $response, $args) {
        $ArrayDeParametros = $request->getParsedBody();
        $id=$ArrayDeParametros['id'];
        $miUsuario= new usuario();
        $miUsuario->setId($id);
        $cantidadDeBorrados=$miUsuario->BorrarUsuario();

        $objDelaRespuesta= new stdclass();
        $objDelaRespuesta->cantidad=$cantidadDeBorrados;
        if($cantidadDeBorrados>0)
            {
                $objDelaRespuesta->resultado="algo borro!!!";
            }
            else
            {
                $objDelaRespuesta->resultado="no Borro nada!!!";
            }
        $newResponse = $response->withJson($objDelaRespuesta, 200);  
        return $newResponse;
    }
     
     public function ModificarUno($request, $response, $args) {
     	//$response->getBody()->write("<h1>Modificar  uno</h1>");
     	$ArrayDeParametros = $request->getParsedBody();  	
	    $miUsuario = new usuario();
	    $miUsuario->id=$ArrayDeParametros['id'];
	    $miUsuario->nombre=$ArrayDeParametros['nombre'];
	    $miUsuario->apellido=$ArrayDeParametros['apellido'];
	    $miUsuario->mail=$ArrayDeParametros['mail'];
	    $miUsuario->clave=$ArrayDeParametros['clave'];

	   	$resultado =$miUsuario->ModificarUsuarioParametros();
	   	$objDelaRespuesta= new stdclass();
           
		$objDelaRespuesta->resultado=$resultado;
		return $response->withJson($objDelaRespuesta, 200);		
    }

    //reponse: 1 si logea - 0 si no logea.
    public function LoginUsuario($request, $response, $args) {
        $ArrayDeParametros = $request->getParsedBody();
        //var_dump($ArrayDeParametros);
        $miUsuario = new usuario();
        $miUsuario->setMail($ArrayDeParametros['mail']);
        $miUsuario->setClave($ArrayDeParametros['clave']);
        //var_dump($miUsuario);
        $resultado = $miUsuario->LogearUsuarioParametros();
        // echo $resultado;
        // var_dump($resultado);
        $objDelaRespuesta= new stdclass();
		$objDelaRespuesta->resultado=$resultado;
		return $response->withJson($objDelaRespuesta, 200);	

    }


}