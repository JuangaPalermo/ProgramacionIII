<?php

include_once "producto.php";

if(isset($_POST['codigoDeBarras']) && isset($_POST['nombre']) && isset($_POST['tipo']) && isset($_POST['stock']) && isset($_POST['precio']))
{
    $codigoDeBarras = $_POST['codigoDeBarras'];
    $nombre = $_POST['nombre'];
    $tipo = $_POST['tipo'];
    $stock = $_POST['stock'];
    $precio = $_POST['precio'];

    //traigo todos los productos, y valido si el codigo de barras es unico
    
    $productosEnBase = array();
    $productosEnBase = Producto::TraerTodosLosProductos();

    $AuxProducto = Producto::__crearProductoParametros($codigoDeBarras, $nombre, $tipo, $stock, $precio);  
    $productoEncontrado = $AuxProducto->ValidarCodigoDeBarras($productosEnBase);

    if ($productoEncontrado)
    {
        //si ya existe el producto, le sumo stock y le cambio fecha de modificacion

        $productoEncontrado->AgregarStock($stock);
        $productoEncontrado->SetFechaDeModificacion(Producto::FechaActual());

        $rowsAfectadas = $productoEncontrado->ModificarProductoParametros();

        print("ROWS AFECTADAS: $rowsAfectadas");

        echo "Actualizado";

    }
    else
    {
        //si es unico, creo el objeto y lo guardo en la bbdd (devuelve "ingresado")

        $AuxProducto->SetFechaDeCreacion(Producto::FechaActual());
        $AuxProducto->SetFechaDeModificacion(Producto::FechaActual());
        
        $idIngresado = $AuxProducto->InsertarProductoParametros();

        
        echo "Ingresado, con el numero de ID $idIngresado";
    }
}
else
{
    //si hay algun problema, devuelve "no se pudo hacer"
    
    echo "No se pudo hacer";

}


?>