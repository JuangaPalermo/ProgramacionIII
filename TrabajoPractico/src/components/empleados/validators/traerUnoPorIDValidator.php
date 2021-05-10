<?php

class TraerUnoPorIDValidator{
    public static function validarID($id)
    {
        if(is_numeric($id))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}