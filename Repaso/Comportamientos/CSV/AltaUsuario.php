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
    
    //leer el archivo csv
    $arrayUsuarios = Usuario::LeerCSV("..\..\Archivos\usuarios.csv");

    //valido que exista ese usuario
    if($usuario->ExisteMail($arrayUsuarios))
    {
        //no se guarda el usuario, se repiten las credenciales

        echo "Ya hay un usuario con ese correo";

    }
    else
    {
        //agregarle el usuario que creo al array
        array_push($arrayUsuarios, $usuario); 

        //escribir nuevamente el archivo csv
        if(Usuario::EscribirCSV('..\..\Archivos\usuarios.csv', $arrayUsuarios))
        {
            echo "Se cargo el archivo correctamente.";
        }
        else
        {
            echo "Error al escribir el archivo.";
        }
    }    

}
else
{
    echo "Faltan parametros obligatorios para esta consulta.";
}

?>