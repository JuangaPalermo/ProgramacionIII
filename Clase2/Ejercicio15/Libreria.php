<?php

function InvertirVector ($vector)
{
    for($i = count($vector)-1; $i >= 0; $i--)
    {
        echo $vector[$i];
    }
}

function ValidarPalabra ($palabra, $max)
{

    if(strlen($palabra) <= $max)
    {
        switch($palabra)
        {
            case "Recuperatorio":
            case "Parcial":
            case "Programacion":
                return 1;
            default:
                return 0;
        }
    }
    else
    {
        return "ERROR - La cantidad de letras de la palabra supera el limite indicado";
    }
        
}

function EsPar ($numero)
{
    $retorno = false;

    if(is_numeric($numero))
    {
        if($numero %2 == 0)
        {
            $retorno = true;
        }

        return $retorno;
    }
    else
    {
        return "ERROR - No se paso un numero entero";
    }
}

function EsImpar ($numero)
{
    if(is_numeric($numero))
    {
        return !EsPar($numero);
    }
    else
    {
        return "ERROR - No se paso un numero entero";
    }
}

?>
