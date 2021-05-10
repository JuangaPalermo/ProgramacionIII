<?php

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



?>