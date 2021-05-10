<?php

include_once "AccesoDatos.php";


class Producto{
    
//--------------------------------//  
//--ATRIBUTOS
    
    protected $id;
    protected $codigoDeBarra;
    protected $nombre;
    protected $tipo;
    protected $stock;
    protected $precio;
    protected $fechaDeCreacion;
    protected $fechaDeModificacion;
    
//--------------------------------//  
    
//--------------------------------//  
//--PROPIEDADES
    
        public function GetId()
        {
            return $this->id;
        }
        public function GetCodigoDeBarra()
        {
            return $this->codigoDeBarra;
        }
        public function GetNombre()
        {
            return $this->nombre;
        }
        public function GetTipo()
        {
            return $this->tipo;
        }
        public function GetStock()
        {
            return $this->stock;
        }
        public function GetPrecio()
        {
            return $this->precio;
        }
        public function GetFechaDeCreacion()
        {
            return $this->fechaDeCreacion;
        }
        public function GetFechaDeModificacion()
        {
            return $this->fechaDeModificacion;
        }

        public function SetId($value)
        {
            $this->id = $value;
        }
        public function SetCodigoDeBarra($value)
        {
            $this->codigoDeBarra = $value;
        }
        public function SetNombre($value)
        {
            $this->nombre = $value;
        }
        public function SetTipo($value)
        {
            $this->tipo = $value;
        }
        public function SetStock($value)
        {
            $this->stock = $value;
        }
        public function SetPrecio($value)
        {
            $this->precio = $value;
        }
        public function SetFechaDeCreacion($value)
        {
            $this->fechaDeCreacion = $value;
        }
        public function SetFechaDeModificacion($value)
        {
            $this->fechaDeModificacion = $value;
        }
    
//--------------------------------// 

//-------------------------------//
//--CONSTRUCTOR

    public function __construct() {}

    public static function __crearProductoParametros($codigoDeBarra, $nombre, $tipo, $stock, $precio)
    {
        if($codigoDeBarra !== NULL && $nombre !== NULL &&  $tipo !== NULL &&  $stock !== NULL &&  $precio !== NULL)
        {
            $producto = new Producto();
            
            $producto->SetCodigoDeBarra($codigoDeBarra);
            $producto->SetNombre($nombre);
            $producto->SetTipo($tipo);
            $producto->SetStock($stock);
            $producto->SetPrecio($precio);
            $producto->SetId(Producto::GenerateId());

            return $producto;
        }

        return NULL;
    }
//-------------------------------//

//--------------------------------//
//--METODOS

    //--GENERALES

        public static function GenerateId()
        {
            return random_int(1,10000);
        }

        public static function FechaActual()
        {
            return date("Y-m-d");
        }

        public function MostrarProducto()
        {
            return " - Codigo: " . $this->GetCodigoDeBarra() .
                " - Nombre: " . $this->GetNombre() .
                " - Tipo: " . $this->GetTipo() . 
                " - Stock: " . $this->GetStock() . 
                " - Precio: " . $this->GetPrecio() .
                " - Fecha de Creacion: " . $this->GetFechaDeCreacion() .
                " - Fecha de Modificacion: " . $this->GetFechaDeModificacion() .
                " - ID: " . $this->GetId();
        }

        ///retorna el objeto con el que coincide, si no, retorna null.
        public function ValidarCodigoDeBarras($productos)
        {
            foreach($productos as $producto)
            {
                if($producto->GetCodigoDeBarra() == $this->GetCodigoDeBarra())
                {
                    return $producto;
                }
            }

            return NULL;
        }

        public function AgregarStock($unidadesParaAgregar)
        {
            $stockActual = $this->GetStock();

            $this->SetStock($stockActual + $unidadesParaAgregar);
        }

       

    //--JSON

        public function GuardarJson()
        {
            if ($archivo = fopen("productos.json", "a"))
            {
                if(fwrite($archivo, json_encode($this->SerializarJson()) . "\n"))
                {
                    fclose($archivo);
                    return true;
                }
                fclose($archivo);
            }

            return false;
        }

        public static function LeerJson()
        {
            if ($archivo = fopen("usuarios.json", "r"))
            {
                $retorno = array();

                while(!feof($archivo))
                {
                    $linea = fgets($archivo);

                    if($linea)
                    {
                        $aux = json_decode($linea, true);

                        if($aux != null)
                        {
                            $producto = Usuario::__crearProductoParametros($aux["codigoDeBarra"], $aux["nombre"], $aux["tipo"], $aux["stock"], $aux["precio"], $aux["fechaDeCreacion"], $aux["fechaDeModificacion"]);
                            $producto->SetId($aux["id"]);

                            array_push($retorno, $producto);
                        }
                    }
                }
                fclose($archivo);
            }

            return $retorno;
        }

        function SerializarJson()
        {
            return get_object_vars($this);
        }
    
    //--HTML

        public static function MostrarProductosHtml($listaProductos)
        {
            $retorno = "<ul>";

            foreach($listaProductos as $producto)
            {
                $retorno .= "<li>".$producto->MostrarProducto()."</li>";
            }

            $retorno .= "</ul>";

            return $retorno;
        }

    //--SQL
        
        public static function TraerTodosLosProductos()
        {
                $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
                $consulta =$objetoAccesoDato->RetornarConsulta("SELECT id as id, 
                                                                codigo_de_barra as codigoDeBarra,
                                                                nombre as nombre,
                                                                tipo as tipo,stock as stock, 
                                                                precio as precio,
                                                                fecha_de_creacion as fechaDeCreacion, 
                                                                fecha_de_modificacion as fechaDeModificacion 
                                                                FROM producto");
                $consulta->execute();			
                return $consulta->fetchAll(PDO::FETCH_CLASS, "producto");		
        } 

        public function ModificarProductoParametros()
        {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("
                UPDATE producto 
                SET nombre=:nombre,
                tipo=:tipo,
                stock=:stock,
                precio=:precio,
                fecha_de_modificacion=:fecha_de_modificacion
                WHERE codigo_de_barra=:codigo_de_barra");        
                $consulta->bindValue(':codigo_de_barra',$this->codigoDeBarra, PDO::PARAM_INT);
                $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
                $consulta->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);
                $consulta->bindValue(':stock', $this->stock, PDO::PARAM_INT);
                $consulta->bindValue(':precio', $this->precio, PDO::PARAM_STR);
                $consulta->bindValue(':fecha_de_modificacion', $this->fechaDeModificacion, PDO::PARAM_STR);
            return $consulta->execute();
        }

        public function InsertarProductoParametros()
        {
                   $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
                   $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into producto (codigo_de_barra,nombre,tipo,stock,precio,fecha_de_creacion,fecha_de_modificacion)
                                                                    values(:codigo_de_barra,:nombre,:tipo,:stock,:precio,:fecha_de_creacion,:fecha_de_modificacion)");
                   $consulta->bindValue(':codigo_de_barra',$this->codigoDeBarra, PDO::PARAM_INT);
                   $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
                   $consulta->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);
                   $consulta->bindValue(':stock', $this->stock, PDO::PARAM_INT);
                   $consulta->bindValue(':precio', $this->precio, PDO::PARAM_INT);
                   $consulta->bindValue(':fecha_de_creacion', $this->fechaDeCreacion, PDO::PARAM_STR);
                   $consulta->bindValue(':fecha_de_modificacion', $this->fechaDeModificacion, PDO::PARAM_STR);
                   $consulta->execute();
                   return $objetoAccesoDato->RetornarUltimoIdInsertado();
        }

//--------------------------------//
}


?>
