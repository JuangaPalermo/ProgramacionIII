<?php
class Rectangulo extends FiguraGeometrica {

    private $_ladoUno;
    private $_ladoDos;

    public function __construct($l1, $l2)
    {
        parent::__construct();
        $this->_ladoUno=$l1;
        $this->_ladoDos=$l2;

        $this->CalcularDatos();
    }

    protected function CalcularDatos()
    {
        $this->_perimetro=($this->_ladoUno * 2) + ($this->_ladoDos * 2);
        $this->_superficie=($this->_ladoUno * $this->_ladoDos);
    }

    public function ToString()
    {
        return parent::ToString() . "<br> -Lado Uno: " . $this->_ladoUno
                                  . "<br> -Lado Dos: " . $this->_ladoDos;
    }

}

?>