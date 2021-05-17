<?php

class altaEmpleadoValidator{
    public static function validarParametros($empleado)
    {
        switch($empleado->getPuesto()){
            case "bartender":
            case "mozo":
            case "cervecero":
            case "cocinero":
            case "socio":
                return true;
                break;
            default:
                return false;
                break;
        }
    }
}