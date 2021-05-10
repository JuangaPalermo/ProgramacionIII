<?php

include_once "AccesoDatos.php";

class Usuario{

//--------------------------------//  
//--ATRIBUTOS
    protected $nombre;
    protected $apellido;
    protected $clave;
    protected $mail;
    protected $id;
    protected $fechaRegistro;
    protected $pathImagen;
    protected $localidad;
//--------------------------------//

//--------------------------------//
//--PROPIEDADES

    public function GetLocalidad()
    {
        return $this->localidad;
    }

    public function GetApellido()
    {
        return $this->apellido;
    }

    public function GetNombre()
    {
        return $this->nombre;
    }

    public function GetClave()
    {
        return $this->clave;
    }

    public function GetMail()
    {
        return $this->mail;
    }

    public function GetId()
    {
        return $this->id;
    }

    public function GetFechaRegistro()
    {
        return $this->fechaRegistro;
    }

    public function GetPathImagen()
    {
        return $this->pathImagen;
    }

    public function SetApellido($value)
    {
        $this->apellido = $value;
    }

    public function SetLocalidad($value)
    {
        $this->localidad = $value;
    }

    public function SetNombre($value)
    {
        $this->nombre = $value;
    }

    public function SetClave($value)
    {
        $this->clave = $value;
    }

    public function SetMail($value)
    {
        $this->mail = $value;
    }

    public function SetId($value)
    {
        $this->id = $value;
    }

    public function SetFechaRegistro($value)
    {
        $this->fechaRegistro = $value;
    }

    public function SetPathImagen($value)
    {
        $this->pathImagen = $value;
    }

//--------------------------------//


//--------------------------------//  
//--CONSTRUCTOR
    public function __construct()
    { }

    public static function __crearUsuarioParametros(string $nombre, string $apellido, string $clave, string $mail, string $localidad)
    {  

        if($nombre !== NULL && $apellido !== NULL && $clave !== NULL && $mail !== NULL && $localidad !== NULL)
        {
            $usuario = new Usuario();

            $usuario->nombre=$nombre;
            $usuario->apellido=$apellido;
            $usuario->clave=$clave;
            $usuario->mail=$mail;
            $usuario->localidad=$localidad;
            $usuario->SetId(self::GenerateId());
            $usuario->SetFechaRegistro(self::FechaActual());

            return $usuario;
        }

        return NULL;
    }

    public static function __crearUsuarioLogin(string $mail, string $clave)
    {
        $usuario = new Usuario();

        if($mail !== NULL && $clave !== NULL)
        {
            $usuario->mail=$mail;
            $usuario->clave=$clave;

            return $usuario;
        }

        return NULL;
    }
//--------------------------------//


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
        
        public function MostrarUsuario()
        {
            return " - Nombre: " . $this->nombre .
            " - Apellido: " . $this->apellido .
            " - Correo: " . $this->mail . 
            " - Fecha de Registro: " . $this->GetFechaRegistro() . 
            " - ID: " . $this->GetId() .
            " - Localidad: " . $this->localidad;
        }
        
        public function LogeoUsuario($listaUsuarios)
        {
            $retorno = "Datos incorrectos";
        
            foreach($listaUsuarios as $usuario)
            {
        
                if($usuario->mail == $this->mail && $usuario->clave == $this->clave)
                {
                    return "Usuario verificado.";   
                }
                else
                {
                    if($usuario->mail != $this->mail)
                    {
                        $retorno = "El mail ingresado es incorrecto.";
                        continue;
                    }
                    else
                    {
                        $retorno = "La contraseña es incorrecta.";
                        continue;
                    }
                }
            }
        
            return $retorno;
        }

    //--CSV

        public function usuarioToCSV()
        {
            return $this->nombre . "," .
                   $this->apellido . "," .
                   $this->mail . "," .
                   $this->GetFechaRegistro() . "," .
                   $this->localidad . "," .
                   $this->clave;
        }


        function GuardarCSV()
        {
            $archivo=fopen("usuarios.csv", "a");
            if(fwrite($archivo,$this->usuarioToCSV()."\n"))
            {
                fclose($archivo);
                echo "Archivo guardado correctamente";
                return $archivo;
            }
            else
            {
                fclose($archivo);
                echo "Error al guardar al usuario";
                return false;
            }    
        }

        public static function LeerCSV($path)
        {
            if(!is_null($path))
            {
                $archivo = fopen($path, "r");
                $arrayUsuarios = array();

                while(!feof($archivo))
                {
                    $renglon = fgets($archivo);

                    if($renglon)
                    {
                        $renglon = str_replace("\n","", $renglon);
                        $arrayAux = explode(",", $renglon);

                        $usuario = Usuario::__crearUsuarioParametros($arrayAux[0], $arrayAux[1], $arrayAux[5], $arrayAux[2], $arrayAux[4]);

                        $arrayUsuarios[] = $usuario;
                    }
                    
                }
                fclose($archivo);
            }

            return $arrayUsuarios;
        }

    //--JSON

        public function GuardarJson()
        {
            if ($archivo = fopen("usuarios.json", "a"))
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
                            $usuario = Usuario::__crearUsuarioParametros($aux["nombre"], $aux["apellido"], $aux["clave"], $aux["mail"], $aux["localidad"]);
                            $usuario->SetId($aux["id"]);
                            $usuario->SetFechaRegistro($aux["fechaRegistro"]);
                            $usuario->SetPathImagen($aux["pathImagen"]);

                            array_push($retorno, $usuario);
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
        
        public static function MostrarUsuariosHtml($listaUsuarios)
        {
            $retorno = "<ul>";

            foreach($listaUsuarios as $usuario)
            {
                $retorno .= "<li>".$usuario->MostrarUsuario()."</li>";
            }

            $retorno .= "</ul>";

            return $retorno;
        }

    //--SQL

        public function InsertarUsuarioParametros()
        {
                    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
                    $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into usuario (nombre,apellido,mail,fecha_de_registro,localidad,clave)
                                                                values(:nombre,:apellido,:mail,:fecha_de_registro,:localidad,:clave)");
                    $consulta->bindValue(':nombre', $this->GetNombre(), PDO::PARAM_STR);
                    $consulta->bindValue(':apellido', $this->GetApellido(), PDO::PARAM_STR);
                    $consulta->bindValue(':mail', $this->GetMail(), PDO::PARAM_STR);
                    $consulta->bindValue(':fecha_de_registro', $this->GetFechaRegistro(), PDO::PARAM_STR);
                    $consulta->bindValue(':localidad', $this->GetLocalidad(), PDO::PARAM_STR);
                    $consulta->bindValue(':clave', $this->GetClave(), PDO::PARAM_STR);
                    $consulta->execute();	
                    return $objetoAccesoDato->RetornarUltimoIdInsertado();
        }


        public static function TraerTodosLosUsuarios()
        {
                $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
                $consulta =$objetoAccesoDato->RetornarConsulta("select id as id,nombre as nombre,
                                                                apellido as apellido,mail as mail, 
                                                                fecha_de_registro as fechaRegistro, localidad as localidad, clave as clave from usuario");
                $consulta->execute();			
                return $consulta->fetchAll(PDO::FETCH_CLASS, "usuario");		
        }

//--------------------------------//

}

?>