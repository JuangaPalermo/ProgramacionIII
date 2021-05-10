<?php 

/* SI IMPLEMENTA ESTOS METODOS YO LO VOY A PODER USAR EN LA API */

interface IApiUsable{ 
   	public function TraerUno($request, $response, $args); 
   	public function TraerTodos($request, $response, $args); 
   	public function CargarUno($request, $response, $args);
   	public function BorrarUno($request, $response, $args);
   	public function ModificarUno($request, $response, $args);

}