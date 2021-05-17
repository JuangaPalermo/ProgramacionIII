<?php

class productoAltaValidator{

    public static function validarParametros($producto)
    {
        switch($producto->getServidoPor()){
            case "bartender":
            case "cervecero":
            case "cocinero":
                return true;
                break;
            default:
                return false;
                break;
        }
    }
}