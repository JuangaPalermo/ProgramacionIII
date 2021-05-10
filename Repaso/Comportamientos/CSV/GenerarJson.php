<?php

include_once "..\..\Entidades\usuario.php";

if(isset($_GET["listado"]))
{
    switch($_GET["listado"])
    {
        case "usuarios.csv":
            Usuario::ArrayToJson("..\..\Archivos\usuarios.json", Usuario::LeerCSV("..\..\Archivos\usuarios.csv"));
            break;
        case "productos.csv":
            break;
        case "vehiculos.csv":
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