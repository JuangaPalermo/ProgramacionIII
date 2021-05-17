<?php

class pedidoListar {

    public static function TraerTodosLosPedidos(){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT idPedido as idPedido, idMesa as idMesa, idCliente as idCliente, idProducto as idProducto, estado as estado, imagen as imagen, fechaCreacion as fechaCreacion, fechaFinalizacion as fechaFinalizacion, tiempoResolucion as tiempoResolucion from pedido");
        $consulta->execute();		
        return $consulta->fetchAll(PDO::FETCH_CLASS, "pedido");
    }
}