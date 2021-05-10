<?php

class Usuario{
    
//atributos
    protected $id;
 	protected $nombre;
  	protected $apellido;
    protected $mail;
  	protected $clave;

//propiedades
    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

 	/**
 	 * Get the value of nombre
 	 */ 
 	public function getNombre()
 	{
 	 	return $this->nombre;
 	}

 	/**
 	 * Set the value of nombre
 	 *
 	 * @return  self
 	 */ 
 	public function setNombre($nombre)
 	{
 	 	$this->nombre = $nombre;

 	 	return $this;
 	}

  	/**
  	 * Get the value of apellido
  	 */ 
  	public function getApellido()
  	{
  	  	return $this->apellido;
  	}

  	/**
  	 * Set the value of apellido
  	 *
  	 * @return  self
  	 */ 
  	public function setApellido($apellido)
  	{
  	  	$this->apellido = $apellido;

  	  	return $this;
  	}

    /**
     * Get the value of mail
     */ 
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set the value of mail
     *
     * @return  self
     */ 
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

  	/**
  	 * Get the value of clave
  	 */ 
  	public function getClave()
  	{
  	  	return $this->clave;
  	}

  	/**
  	 * Set the value of clave
  	 *
  	 * @return  self
  	 */ 
  	public function setClave($clave)
  	{
  	  	$this->clave = $clave;

  	  	return $this;
  	}
//constructor
    public function __construct(){}

//consultas

    public static function TraerTodoLosUsuarios()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT id,nombre as nombre,apellido as apellido,mail as mail,clave as clave from usuarios");
        $consulta->execute();			
        return $consulta->fetchAll(PDO::FETCH_CLASS, "usuario");		
    }

    public static function TraerUnUsuario($id) 
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT id,nombre as nombre,apellido as apellido,mail as mail,clave as clave from usuarios where id = $id");
        $consulta->execute();
        $usuarioBuscado= $consulta->fetchObject('usuario');
        return $usuarioBuscado;
    }
    
    public function InsertarElUsuarioParametros()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into usuarios (nombre,apellido,mail,clave)values(:nombre,:apellido,:mail,:clave)");
        $consulta->bindValue(':nombre', $this->getNombre(), PDO::PARAM_STR);
        $consulta->bindValue(':apellido', $this->getApellido(), PDO::PARAM_STR);
        $consulta->bindValue(':mail', $this->getMail(), PDO::PARAM_STR);
        $consulta->bindValue(':clave',$this->getClave(), PDO::PARAM_STR);
        $consulta->execute();		
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

    public function BorrarUsuario()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("DELETE 
                                                        from usuarios 				
                                                        WHERE id=:id");	
            $consulta->bindValue(':id',$this->id, PDO::PARAM_INT);		
            $consulta->execute();
            return $consulta->rowCount();
    }

    public function ModificarUsuarioParametros()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE usuarios 
                                                        set nombre=:nombre,
                                                        apellido=:apellido,
                                                        mail=:mail,
                                                        clave=:clave,
                                                        WHERE id=:id");
        $consulta->bindValue(':id',$this->id, PDO::PARAM_INT);
        $consulta->bindValue(':nombre',$this->getNombre(), PDO::PARAM_STR);
        $consulta->bindValue(':apellido', $this->getApellido(), PDO::PARAM_STR);
        $consulta->bindValue(':mail', $this->getMail(), PDO::PARAM_STR);
        $consulta->bindValue(':clave', $this->getClave(), PDO::PARAM_STR);
        return $consulta->execute();
    }

    public function mostrarDatos()
    {
        return "Metodo mostar:".$this->id."  ".$this->nombre."  ".$this->apellido."  ".$this->mail."  ".$this->clave;
    }
}


?>