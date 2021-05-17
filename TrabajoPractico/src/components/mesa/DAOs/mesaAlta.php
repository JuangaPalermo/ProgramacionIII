<?php

class mesaAlta{

    public static function InsertarMesaParametros ($mesa){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into mesa (estado)values(:estado)");
        $consulta->bindValue(':estado', $mesa->getEstado(), PDO::PARAM_STR);
        $consulta->execute();		
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

}