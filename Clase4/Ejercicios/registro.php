<?php


require "usuario.php";

if(isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['clave']) && isset($_POST['mail']) && isset($_POST['localidad']))
{
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $clave = $_POST['clave'];
    $mail = $_POST['mail'];
    $localidad = $_POST['localidad'];
    
    $usuario = Usuario:: __crearUsuarioParametros($nombre, $apellido, $clave, $mail, $localidad);
    $usuario->GuardarCSV();
}

if(isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['clave']) && isset($_POST['mail']) && isset($_POST['localidad']) && $_FILES["imagen"])
{
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $clave = $_POST['clave'];
    $mail = $_POST['mail'];
    $localidad = $_POST['localidad'];

    $usuario = Usuario:: __crearUsuarioParametros($nombre, $apellido, $clave,$mail,$localidad);

    $nombreImagen = $mail . $_FILES["imagen"]["name"];

    $destino = "Usuario/Fotos/".$nombreImagen;

    move_uploaded_file($_FILES["imagen"]["tmp_name"], $destino);

    $usuario->SetPathImagen($destino);
    
    $usuario->GuardarJson();

    $ultimoId = $usuario->InsertarUsuarioParametros();
    $usuario->SetId($ultimoId);
}


?>
