<?php

class productoTraerPorID{

    
    public static function TraerProductoPorID($idProducto){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM producto WHERE idProducto=:idProducto");
        $consulta->bindValue(':idProducto', $idProducto, PDO::PARAM_INT);
        $consulta->execute();
        $clienteBuscado = $consulta->fetchObject('producto');		
        return $clienteBuscado;
    }

}