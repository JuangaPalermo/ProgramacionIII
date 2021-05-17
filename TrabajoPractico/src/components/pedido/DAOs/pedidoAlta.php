<?php

class pedidoAlta{

    public static function InsertarPedidoParametros($miPedido, $miMesa, $miCliente, $miProducto){

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into pedido (idPedido,idMesa,idCliente,emailCliente,idProducto,nombreProducto,servidoPor,estado,fechaCreacion)values(:idPedido,:idMesa,:idCliente,:emailCliente,:idProducto,:nombreProducto,:servidoPor,:estado,:fechaCreacion)");
        $consulta->bindValue(':idPedido', $miPedido->getIdPedido(), PDO::PARAM_STR);
        $consulta->bindValue(':idMesa', $miPedido->getIdMesa(), PDO::PARAM_INT);
        $consulta->bindValue(':idCliente', $miPedido->getIdCliente(), PDO::PARAM_INT);
        $consulta->bindValue(':emailCliente', $miCliente->getEmail(), PDO::PARAM_STR);
        $consulta->bindValue(':idProducto', $miPedido->getIdProducto(), PDO::PARAM_INT);
        $consulta->bindValue(':nombreProducto', $miProducto->getNombre(), PDO::PARAM_STR);
        $consulta->bindValue(':servidoPor', $miProducto->getServidoPor(), PDO::PARAM_STR);
        $consulta->bindValue(':estado', $miPedido->getEstado(), PDO::PARAM_STR);
        $consulta->bindValue(':fechaCreacion', $miPedido->getFechaCreacion(), PDO::PARAM_STR);

        $consulta->execute();		
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }
}