<?php

class clienteListar{

    public static function TraerTodosLosClientes ()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * from cliente");
        $consulta->execute();		
        return $consulta->fetchAll(PDO::FETCH_CLASS, "cliente");
    }

}