<?php

class pedidoTraerPorID{

    public static function TraerPedidoPorID($id){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT idPedido as idPedido, idMesa as idMesa, idCliente as idCliente, idProducto as idProducto, estado as estado, imagen as imagen, fechaCreacion as fechaCreacion, fechaFinalizacion as fechaFinalizacion, tiempoResolucion as tiempoResolucion FROM pedido WHERE idPedido=:id");
        $consulta->bindValue(':id', $id, PDO::PARAM_STR);
        $consulta->execute();
        $pedidoBuscado = $consulta->fetchObject('pedido');		
        return $pedidoBuscado;
    }
}