<?php

class clienteTraerPorID{
    
    public static function TraerClientePorID($id){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM cliente WHERE id=:id");
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();
        $clienteBuscado = $consulta->fetchObject('cliente');		
        return $clienteBuscado;
    }
}