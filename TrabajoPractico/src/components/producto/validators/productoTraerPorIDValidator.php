<?php

class productoTraerPorIDValidator{
    public static function validarID($idProducto){
        if(is_numeric($idProducto))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}