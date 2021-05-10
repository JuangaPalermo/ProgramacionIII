<?php

class Usuario{

//--------------------------------//  
//--ATRIBUTOS
    protected $nombre;
    protected $clave;
    protected $mail;
    protected $id;
    protected $fechaRegistro;
    protected $pathImagen;
//--------------------------------//

//--------------------------------//
//--PROPIEDADES
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
    public function __construct(string $nombre, string $clave, string $mail)
    {
        if($nombre !== NULL && $clave !== NULL && $mail !== NULL)
        {
            $this->nombre=$nombre;
            $this->clave=$clave;
            $this->mail=$mail;
            $this->SetId(self::GenerateId());
            $this->SetFechaRegistro(self::FechaActual());
        }
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
            return date("d/m/y");
        }
        
        public function MostrarUsuario()
        {
            return " - Nombre: " . $this->nombre . 
            " - Correo: " . $this->mail . 
            " - Fecha de Registro: " . $this->GetFechaRegistro() . 
            " - ID: " . $this->GetId();
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
            return $this->nombre . "," .$this->clave . "," .$this->mail;
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

                        $usuario = new Usuario($arrayAux[0], $arrayAux[1], $arrayAux[2]);

                        $arrayUsuarios[] = $usuario;
                    }
                    
                }
                fclose($archivo);
            }

            return $arrayUsuarios;
        }

    //--JSON

        public static function GuardarJson()
        {
            $json = json_encode($this);
            var_dump($json);
            $archivo = 'usuarios.json';
            return file_put_contents($archivo, $json);
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

//--------------------------------//

}

?>