<?php

class productoAlta{

    public static function InsertarProductoParametros ($producto)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into producto (nombre,precio,servidoPor)values(:nombre, :precio, :servidoPor)");
        $consulta->bindValue(':nombre', $producto->getNombre(), PDO::PARAM_STR);
        $consulta->bindValue(':precio', $producto->getPrecio(), PDO::PARAM_INT);
        $consulta->bindValue(':servidoPor', $producto->getServidoPor(), PDO::PARAM_STR);
        $consulta->execute();		
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }
}