<?php

class productoListar{

    public static function TraerTodosLosProductos(){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * from producto");
        $consulta->execute();		
        return $consulta->fetchAll(PDO::FETCH_CLASS, "producto");
    }
}