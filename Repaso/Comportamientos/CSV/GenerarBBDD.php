<?php

    include_once "..\..\Entidades\usuario.php";
    
    //leer el csv y pasarlo a un array
    $arrayUsuarios = Usuario::LeerCSV("..\..\Archivos\usuarios.csv");
    //pushear el array a la bbdd
    echo Usuario::InsertarUsuariosToBBDD($arrayUsuarios);


    //el metodo que cree sirve tanto para pasar arrays a la bbdd, como para pasar usuarios individuales
    $user = Usuario::__constructorParametrizado("nombrecito", "apellidito", "uwuwu1010", "test@rancio.uwu");
    //pusheo el usuario a la bbdd
    echo Usuario::InsertarUsuariosToBBDD($user);

?>