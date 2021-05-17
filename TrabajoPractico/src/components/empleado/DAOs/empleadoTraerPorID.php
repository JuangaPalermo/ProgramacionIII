<?php

class empleadoTraerPorID{
    
    public static function TraerEmpleadoPorID($id){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM empleado WHERE id=:id");
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();
        $clienteBuscado = $consulta->fetchObject('empleado');		
        return $clienteBuscado;
    }
}