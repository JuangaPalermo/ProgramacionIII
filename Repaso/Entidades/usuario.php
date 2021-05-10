<?php

include_once "..\..\Entidades\AccesoDatos.php";

class Usuario{
//ATRIBUTOS
    protected $nombre;
    protected $apellido;
    protected $clave;
    protected $mail;
    protected $id;

    
//PROPIEDADES
    public function GetNombre()
    {
        return $this->nombre;
    }
    public function GetApellido()
    {
        return $this->apellido;
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


    public function SetNombre($value)
    {
        $this->nombre = $value;

        return $this->nombre;
    }
    public function SetApellido($value)
    {
        $this->apellido = $value;

        return $this->apellido;
    }
    public function SetClave($value)
    {
        $this->clave = $value;

        return $this->clave;
    }
    public function SetMail($value)
    {
        $this->mail = $value;

        return $this->mail;
    }
    public function SetId($id)
    {
        $this->id = $id;

        return $this;
    }
    
//CONSTRUCTORES
    public function __construct(){}

    public static function __constructorParametrizado($nombre, $apellido, $clave, $mail)
    {
        if($nombre && $clave && $mail && $apellido)
        {
            $usuario = new Usuario();

            $usuario->SetNombre($nombre);
            $usuario->SetApellido($apellido);
            $usuario->SetClave($clave);
            $usuario->SetMail($mail);
            $usuario->SetId(random_int(1,300));

            return $usuario;
        }

        return NULL;
    }

//METODOS

    //GENERALES
        public function ActualizarUsuariosFromArray($arrayUsuarios)
        {
            foreach($arrayUsuarios as $usuario)
            {
                if($this->GetMail() == $usuario->GetMail() && $this->GetClave() == $usuario->GetClave())
                {
                    $usuario->SetNombre($this->GetNombre());
                    $usuario->SetApellido($this->GetApellido());
                    return $arrayUsuarios;
                }
            }

            return NULL;
        }

        public function EliminarUsuarioFromArray($arrayUsuarios)
        {
            foreach($arrayUsuarios as $key => $usuario)
            {
                if($this->GetMail() == $usuario->GetMail() && $this->GetClave() == $usuario->GetClave())
                {
                    unset($arrayUsuarios[$key]);
                    array_values($arrayUsuarios);
                    return $arrayUsuarios;
                }
            }

            return NULL;
        }

        public function UsuarioToString()
        {
            return "Nombre: " . $this->GetNombre() . "\n" .
                "Apellido: " . $this->GetApellido() . "\n" . 
                "Clave: " . $this->GetClave() . "\n" . 
                "Mail: " . $this->GetMail();
        }

        public function ExisteMail($arrayUsuarios)
        {
            foreach($arrayUsuarios as $usuario)
            {
                if($this->GetMail() == $usuario->GetMail())
                {
                    return true;
                }
            }

            return false;
        }

        public function LoginUsuario($arrayUsuarios)
        {
            $retorno = "No existe ningun usuario con ese mail ni con esa contraseña";
            $flagMail = 0;
            $flagClave = 0;

            foreach($arrayUsuarios as $usuario)
            {
                if($this->GetMail() == $usuario->GetMail() && $this->GetClave() == $usuario->GetClave())
                {
                    return "Usuario ingresado correctamente";
                }

                if($this->GetMail() == $usuario->GetMail() && $flagMail==0)
                {
                    $flagMail = 1;
                }
                if($this->GetClave() == $usuario->GetClave() && $flagClave==0);
                {
                    $flagClave = 1;
                }
            }

            if ($flagMail == 1)
            {
                $retorno = "El mail existe, pero la contraseña no es correcta";
            }
            if ($flagClave == 1)
            {
                $retorno = "La contraseña existe, pero el mail no es correcto";
            }

            return $retorno;
        }


    //CSV

        public static function EscribirCSV($path, $myArray)
        {
            if(($fp = fopen($path, 'w')) !== FALSE)
            {
                foreach ($myArray as $fields) {
                    //si el elemento es un objeto
                    if( is_object($fields) )
                    {
                        //lo seteo como array para mandarselo al fputcsv
                        $fields = (array)$fields;
                    }
                    //inserto el elemento en el csv
                    fputcsv($fp, $fields);
                }
                
                fclose($fp);
                return true;
            }
            else
            {
                return false;
            }
        }

        public static function LeerCSV($path)
        {
            if (($handler = fopen($path, "r")) !== FALSE) 
            {
                // Convierte la linea en array
                while (($data = fgetcsv($handler, 1000, ",")) !== FALSE) 
                {		
                    // Gestiono el array
                    $usuario = Usuario::__constructorParametrizado($data[0], $data[1], $data[2], $data[3]);
                    $arrayUsuarios[] = $usuario;
                }

                // Cierro el archivo
                fclose($handler);
            }
            else
            {
                return NULL;
            }

            return $arrayUsuarios;
        }

    //JSON
        public static function ArrayToJson($path, $array)
        {
            if ($handler = fopen($path, "w"))
            {   
                //hago que la numeracion del array sea consecutiva, para evitar problemas en el encode
                $auxArray = array_values($array);

                foreach($auxArray as $elemento)
                {
                    //Genera el json del objeto, dandole las propiedades a traves de la serializacion.
                    fwrite($handler, json_encode($elemento->SerializarJson()) . "\n");
                }

                fclose($handler);

                return true;
            }

            return false;
        }

        public static function LeerJSON($path)
        {
            if ($handler = fopen($path, "r"))
            {
                $retorno = array();
                while(!feof($handler))
                {
                    $linea = fgets($handler);
                    if($linea != null)
                    {
                        $aux = json_decode($linea, true);

                        if($aux != null)
                        {
                            $usuario = Usuario::__constructorParametrizado($aux["nombre"], $aux["apellido"], $aux["clave"], $aux["mail"]);
                            array_push($retorno, $usuario);
                        }
                        
                    }

                }
                return $retorno;               
            }

            return false;

        }

        private function SerializarJson()
        {
            return get_object_vars($this);
        }

    //HTML

        public static function UsuariosToHTML($arrayUsuarios)
        {
            echo "<ul>";
            foreach($arrayUsuarios as $key=>$usuario)
            {
                echo "<li>";
                echo $usuario->UsuarioToString();
                echo "</li>";
            }
            echo "</ul>";
        }

    //SQL

        public static function InsertarUsuariosToBBDD($param)
        {
            if(is_array($param))
            {
                foreach($param as $usuario)
                {
                    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
                    $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into usuario (nombre,apellido,clave,mail)values(:nombre,:apellido,:clave,:mail)");
                    $consulta->bindValue(':nombre',$usuario->GetNombre(), PDO::PARAM_STR);
                    $consulta->bindValue(':apellido', $usuario->GetApellido(), PDO::PARAM_STR);
                    $consulta->bindValue(':clave', $usuario->GetClave(), PDO::PARAM_STR);
                    $consulta->bindValue(':mail', $usuario->GetMail(), PDO::PARAM_STR);
                    $consulta->execute();
                }
            }
            else
            {
                $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
                $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into usuario (nombre,apellido,clave,mail)values(:nombre,:apellido,:clave,:mail)");
                $consulta->bindValue(':nombre',$param->GetNombre(), PDO::PARAM_STR);
                $consulta->bindValue(':apellido', $param->GetApellido(), PDO::PARAM_STR);
                $consulta->bindValue(':clave', $param->GetClave(), PDO::PARAM_STR);
                $consulta->bindValue(':mail', $param->GetMail(), PDO::PARAM_STR);
                $consulta->execute();
            }
            		
            return $objetoAccesoDato->RetornarUltimoIdInsertado();
        }

        public static function TraerUsuariosFromBBDD()
        {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id, nombre as nombre, apellido as apellido,clave as clave, mail as mail from usuario");
			$consulta->execute();
			return $consulta->fetchAll(PDO::FETCH_CLASS, "usuario");
        }

        public static function TraerPorID($id) 
	    {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id, nombre as nombre, apellido as apellido,clave as clave, mail as mail from usuario where id = $id");
			$consulta->execute();
			$usuarioBuscado= $consulta->fetchObject('usuario');
			return $usuarioBuscado;				
	    }

        public static function TraerPorMail($mail) 
	    {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id, nombre as nombre, apellido as apellido,clave as clave, mail as mail from usuario where mail = $mail");
			$consulta->execute();
			$usuarioBuscado= $consulta->fetchObject('usuario');
			return $usuarioBuscado;				
	    }

            
            
}



?>
