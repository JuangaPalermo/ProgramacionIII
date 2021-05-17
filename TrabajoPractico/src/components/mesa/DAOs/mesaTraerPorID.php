<?php

class mesaTraerPorID{
    
    public static function TraerMesaPorID($id){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM mesa WHERE id=:id");
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->execute();
        $mesaBuscada = $consulta->fetchObject('mesa');		
        return $mesaBuscada;
    }
}