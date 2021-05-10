<?php

class empleadoListar{

    public static function TraerTodosLosEmpleados() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * from empleado");
        $consulta->execute();		
        return $consulta->fetchAll(PDO::FETCH_CLASS, "empleado");
    }
}