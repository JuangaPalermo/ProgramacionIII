<?php

class Pedido{

//atributos
    public $idPedido;
    public $idMesa;
    public $idCliente;
    public $idProducto;
    public $estado;
    public $imagen;
    public $fechaCreacion;
    public $fechaFinalizacion;
    public $tiempoResolucion;
//constructor
    public function __construct(){}
//methods
    public static function generateAlphanumeric(){
        $chars = 'abcdefghijklmnopqrstuvwxyz';
        $numbers = '0123456789';
        return substr(str_shuffle($chars), 0, 2) . substr(str_shuffle($numbers),0,3);
    }
//propiedades
    /**
     * Get the value of tiempoResolucion
     */ 
    public function getTiempoResolucion()
    {
        return $this->tiempoResolucion;
    }

    /**
     * Set the value of tiempoResolucion
     *
     * @return  self
     */ 
    public function setTiempoResolucion($tiempoResolucion)
    {
        $this->tiempoResolucion = $tiempoResolucion;

        return $this;
    }

    /**
     * Get the value of fechaFinalizacion
     */ 
    public function getFechaFinalizacion()
    {
        return $this->fechaFinalizacion;
    }

    /**
     * Set the value of fechaFinalizacion
     *
     * @return  self
     */ 
    public function setFechaFinalizacion($fechaFinalizacion)
    {
        $this->fechaFinalizacion = $fechaFinalizacion;

        return $this;
    }

    /**
     * Get the value of fechaCreacion
     */ 
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * Set the value of fechaCreacion
     *
     * @return  self
     */ 
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * Get the value of imagen
     */ 
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set the value of imagen
     *
     * @return  self
     */ 
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Get the value of estado
     */ 
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set the value of estado
     *
     * @return  self
     */ 
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get the value of idProducto
     */ 
    public function getIdProducto()
    {
        return $this->idProducto;
    }

    /**
     * Set the value of idProducto
     *
     * @return  self
     */ 
    public function setIdProducto($idProducto)
    {
        $this->idProducto = $idProducto;

        return $this;
    }

    /**
     * Get the value of idCliente
     */ 
    public function getIdCliente()
    {
        return $this->idCliente;
    }

    /**
     * Set the value of idCliente
     *
     * @return  self
     */ 
    public function setIdCliente($idCliente)
    {
        $this->idCliente = $idCliente;

        return $this;
    }

    /**
     * Get the value of idMesa
     */ 
    public function getIdMesa()
    {
        return $this->idMesa;
    }

    /**
     * Set the value of idMesa
     *
     * @return  self
     */ 
    public function setIdMesa($idMesa)
    {
        $this->idMesa = $idMesa;

        return $this;
    }

    /**
     * Get the value of idPedido
     */ 
    public function getIdPedido()
    {
        return $this->idPedido;
    }

    /**
     * Set the value of idPedido
     *
     * @return  self
     */ 
    public function setIdPedido($idPedido)
    {
        $this->idPedido = $idPedido;

        return $this;
    }
}