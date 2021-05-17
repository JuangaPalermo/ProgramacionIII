<?php

class empleadoAlta{

    public static function InsertarEmpleadoParametros ($empleado)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into empleado (nombre,apellido,puesto)values(:nombre,:apellido,:puesto)");
        $consulta->bindValue(':nombre', $empleado->getNombre(), PDO::PARAM_STR);
        $consulta->bindValue(':apellido', $empleado->getApellido(), PDO::PARAM_STR);
        $consulta->bindValue(':puesto', $empleado->getPuesto(), PDO::PARAM_STR);
        $consulta->execute();		
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

}