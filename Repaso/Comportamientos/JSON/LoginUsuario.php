<?php

include_once "..\..\Entidades\usuario.php";

if (isset($_POST["clave"]) && isset($_POST["mail"]))
{
    $clave = $_POST["clave"];
    $mail = $_POST["mail"];
    
    //creo el usuario con los parametros recibidos
    $usuario = Usuario::__constructorParametrizado("", "", $clave, $mail);
    
    //leer el archivo csv
    $arrayUsuarios = Usuario::LeerJSON("..\..\Archivos\usuarios.json");

    echo $usuario->LoginUsuario($arrayUsuarios);

}
else
{
    echo "Faltan parametros obligatorios para esta consulta.";
}

?>