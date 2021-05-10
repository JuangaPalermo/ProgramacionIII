<?php

include_once "..\..\Entidades\usuario.php";

if (isset($_POST["nombre"]) && isset($_POST["apellido"]) && isset($_POST["clave"]) && isset($_POST["mail"]))
{
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $clave = $_POST["clave"];
    $mail = $_POST["mail"];

    //creo el usuario con los datos que recibo

    //actualizo en la bbdd where mail sea == a mail de bbdd

    //si no hay tal dato, notificarlo

}
else
{
    echo "Faltan parametros obligatorios para esta consulta.";
}
    
?>