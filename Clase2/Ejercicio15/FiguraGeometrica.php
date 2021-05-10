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

    public function get_Color()
    {
        return $this->_color;
    }

    public function set_Color($_color)
    {
        $this->_color = $_color;
    }

    #CONSTRUCTOR

    public function __construct() {

        $this->_perimetro = 0;
        $this->_superficie = 0;
        $this->_color="red";
    }

    #METODOS

    public function ToString() {

        return " - Color: " . $this->GetColor() .  
               "<br> - Perimetro: " . $this->_perimetro . 
               "<br> - Superficie: " . $this->_superficie;

    }

    public abstract function Dibujar();

    protected abstract function CalcularDatos();


}

?>