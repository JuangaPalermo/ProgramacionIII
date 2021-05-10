<?php

include_once "..\..\Entidades\usuario.php";

if(isset($_GET["listado"]))
{
    switch($_GET["listado"])
    {
        case "usuarios.json":
            Usuario::EscribirCSV("..\..\Archivos\usuarios.csv", Usuario::LeerJSON("..\..\Archivos\usuarios.json"));
            break;
        case "productos.json":
            break;
        case "vehiculos.json":
            break;
        default:
            echo "Ese listado no existe en este programa";
            break;
    }
}
else
{
    echo "Faltan parametros obligatorios para esta consulta";
}


?>