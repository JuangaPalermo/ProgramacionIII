<?php

include_once "..\..\Entidades\usuario.php";

if (isset($_POST["nombre"]) && isset($_POST["apellido"]) && isset($_POST["clave"]) && isset($_POST["mail"]))
{
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $clave = $_POST["clave"];
    $mail = $_POST["mail"];
    
    //creo el usuario con los parametros recibidos
    $usuario = Usuario::__constructorParametrizado($nombre, $apellido, $clave, $mail);
    
    //Traer de BBDD a array
    $arrayUsuarios = Usuario::TraerUsuariosFromBBDD();

    //valido que exista ese usuario
    if($usuario->ExisteMail($arrayUsuarios))
    {
        //no se guarda el usuario, se repiten las credenciales
        echo "Ya hay un usuario con ese correo";
    }
    else
    {
        //pushear el usuario a la bbdd
        echo "Se inserto el usuario con el ID: " . Usuario::InsertarUsuariosToBBDD($usuario);
    }    

}
else
{
    echo "Faltan parametros obligatorios para esta consulta.";
}

?>