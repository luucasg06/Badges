<?php
class Productos{
	var $nombre;
	var $imagen;
	
	function __construct($nombreC,$imagenC){
		$this->nombre=$nombreC;
		$this->imagen=$imagenC;
	}
	function setNombre($nomUsu){
		$this->nombre=$nomUsu;
	}
	function getNombre(){
		return $this->nombre;
	}
	function setImagen($img){
		$this->imagen=$img;
	}
	function getImagen(){
		return $this->imagen;
	}
}
?>