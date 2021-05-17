<?php

class clienteAlta{

    public static function InsertarClienteParametros ($cliente)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into cliente (nombre,apellido,email)values(:nombre,:apellido,:email)");
        $consulta->bindValue(':nombre', $cliente->getNombre(), PDO::PARAM_STR);
        $consulta->bindValue(':apellido', $cliente->getApellido(), PDO::PARAM_STR);
        $consulta->bindValue(':email', $cliente->getEmail(), PDO::PARAM_STR);
        $consulta->execute();		
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

}