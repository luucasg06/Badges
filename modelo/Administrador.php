<?php
class Administrador{
	var $nombre;
	var $contrasena;
	

	function __construct($nombreA,$contrasenaA){
		$this->nombre=$nombreA;
		$this->contrasena=$contrasenaA;
		
	}
	function setNombre($nomA){
		$this->nombre=$nomA;
	}
	function getNombre(){
		return $this->nombre;
	}
	function setContrasena($contrasenaAd){
		$this->contrasena=$ContrasenaAd;
	}
	function getContrasena(){
		return $this->contrasena;
	}	

}
?>