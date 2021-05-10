<?php


require "usuario.php";


if(isset($_POST["clave"]) && isset($_POST["mail"]))
{
    $usuarios = array();
    $mail = $_POST["mail"];
    $clave = $_POST["clave"];

    $usuarios = Usuario::LeerCSV("usuarios.csv");

    $auxLogin = new Usuario("", $clave, $mail);

    echo $auxLogin -> LogeoUsuario($usuarios);
}
else
{
    echo "Error al acceder al archivo";
}



?>