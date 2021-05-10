<?php


require "usuario.php";

if(isset($_POST['nombre']) && isset($_POST['clave']) && isset($_POST['mail']))
{
    $nombre = $_POST['nombre'];
    $clave = $_POST['clave'];
    $mail = $_POST['mail'];
    
    $usuario = new Usuario($nombre,$clave,$mail);
    $usuario->GuardarCSV();
}

if(isset($_POST['nombre']) && isset($_POST['clave']) && isset($_POST['mail']) && $_FILES["imagen"])
{
    $nombre = $_POST['nombre'];
    $clave = $_POST['clave'];
    $mail = $_POST['mail'];

    $usuario = new Usuario($nombre,$clave,$mail);

    $nombreImagen = $mail . $_FILES["imagen"]["type"];

    $destino = "Usuario\Fotos\\".$nombreImagen;

    move_uploaded_file($_FILES["imagen"]["tmp_name"], $destino);

    $usuario->SetPathImagen($destino);

    $usuario->GuardarJson();
}


?>
