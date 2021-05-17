<?php

class Producto {
//atributos
    public $idProducto;
    public $nombre;
    public $precio;
    public $servidoPor;
//constructor
    public function __construct(){}
//propiedades
    /**
     * Get the value of id
     */ 
    public function getIdProducto()
    {
        return $this->idProducto;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setIdProducto($idProducto)
    {
        $this->idProducto = $idProducto;

        return $this;
    }

    /**
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of precio
     */ 
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set the value of precio
     *
     * @return  self
     */ 
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get the value of servidoPor
     */ 
    public function getServidoPor()
    {
        return $this->servidoPor;
    }

    /**
     * Set the value of servidoPor
     *
     * @return  self
     */ 
    public function setServidoPor($servidoPor)
    {
        $this->servidoPor = $servidoPor;

        return $this;
    }
}