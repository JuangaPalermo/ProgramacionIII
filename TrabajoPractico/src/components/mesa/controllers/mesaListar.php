<?php

class mesaListar{

    public static function TraerTodasLasMesas() {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * from mesa");
        $consulta->execute();		
        return $consulta->fetchAll(PDO::FETCH_CLASS, "mesa");
    }
}