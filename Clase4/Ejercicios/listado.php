<?php

/* JUAN GABRIEL PALERMO

Aplicación No 28 ( Listado BD)
Archivo: listado.php
método:GET
Recibe qué listado va a retornar(ej:usuarios,productos,ventas)
cada objeto o clase tendrán los métodos para responder a la petición
devolviendo un listado <ul> o tabla de html <table> */

require "usuario.php";


if(isset($_GET["archivo"]))
{
    $listado = $_GET["archivo"];
    switch($listado)
    {
        case "usuarios.csv":
            $auxUsuarios = array();
            $auxUsuarios = Usuario::LeerCSV($listado);
            echo Usuario::MostrarUsuariosHtml($auxUsuarios);           
        break;
        case "vehiculos.csv":
        break;
        case "productos.csv":
        break;     
        default:
        break;
    }
    

}else{
    echo "Error al acceder al archivo";
}

if(isset($_GET["archivo"]))
{
    $listado = $_GET["archivo"];

    switch($listado)
    {
        case "usuarios.json":
            $auxUsuarios = array();
            $auxUsuarios = Usuario::LeerJson();
            echo Usuario::MostrarUsuariosHtml($auxUsuarios);
        break;
        case "vehiculos.json":
        break;
        case "productos.json":
        break;     
        default:
        break;
    }
}

if(isset($_GET["archivo"]))
{
    $listado = $_GET["archivo"];

    switch($listado)
    {
        case "usuarios.sql":
            $auxUsuarios = array();
            $auxUsuarios = Usuario::TraerTodosLosUsuarios();
            echo Usuario::MostrarUsuariosHtml($auxUsuarios);
        break;
        break;
        case "vehiculos.json":
        break;
        case "productos.json":
        break;     
        default:
        break;
    }
}



?>