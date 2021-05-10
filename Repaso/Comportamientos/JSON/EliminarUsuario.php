<?php

include_once "..\..\Entidades\usuario.php";

if (isset($_POST["nombre"]) && isset($_POST["apellido"]) && isset($_POST["clave"]) && isset($_POST["mail"]))
{
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $clave = $_POST["clave"];
    $mail = $_POST["mail"];

    //creo el usuario con los datos proporcionados
    $usuario = Usuario::__constructorParametrizado($nombre, $apellido, $clave, $mail);

    //traigo todos los usuarios que tengo en el archivo guardados
    $arrayUsuarios = Usuario::LeerJSON("..\..\Archivos\usuarios.json");

    $arrayActualizado = $usuario->EliminarUsuarioFromArray($arrayUsuarios);

    //actualizo en caso de coincidencia (modifico el array de usuarios)
    if($arrayActualizado == NULL)
    {
        //Si es null, informar que no hay credenciales coincidentes
        echo "No habia ningun registro para modificar con esas credenciales";
    }
    else
    {
        //Si no es null, significa que modifico el array
        Usuario::ArrayToJson('..\..\Archivos\usuarios.json', $arrayActualizado);
        echo "Se ha actualizado el archivo";        
    }  
}
else
{
    echo "Faltan parametros obligatorios para esta consulta.";
}
    
?>