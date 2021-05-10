<?php
/*
La clase FiguraGeometrica posee: todos sus atributos protegidos, un constructor por defecto,
un método getter y setter para el atributo _color, un método virtual (ToString) y dos
métodos abstractos: Dibujar (público) y CalcularDatos (protegido).
*/

abstract class FiguraGeometrica
{
    #ATRIBUTOS

    protected $_color;
    protected $_perimetro;
    protected $_superficie;

    #PROPIEDADES

    public function GetColor()
    {
        return $this->_color;
    }

    public function setColor($_color)
    {
        $this->_color = $_color;
    }

    #CONSTRUCTOR

    public function FiguraGeometrica() { }

    #METODOS

    public function ToString() {}

    public abstract function Dibujar();

    protected abstract function CalcularDatos();


}

?>