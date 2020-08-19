<?php
class Clientes{
	var $nombre;
	var $tipocliente;
	var $fecharegistro;
	var $fechainactivo;
	var $imagen;
	var $email;
	var $telefono;
	var $topecredito;
	var $idUser;
	var $lat;
	var $long;

	
	function __construct($nombreC,$tipoclienteC,$fecharegistroC,$fechainactivoC,$imagenC,$emailC,$telefonoC,$topecreditoC,$idUserC,$latc,$longc){
		$this->nombre=$nombreC;
		$this->tipocliente=$tipoclienteC;
		$this->fecharegistro=$fecharegistroC;
		$this->fechainactivo=$fechainactivoC;
		$this->imagen=$imagenC;
		$this->email=$emailC;
		$this->telefono=$telefonoC;
		$this->topecredito=$topecreditoC;
		$this->idUser=$idUserC;
		$this->lat=$latc;
		$this->long=$longc;
	}
	function setNombre($nomUsu){
		$this->nombre=$nomUsu;
	}
	function getNombre(){
		return $this->nombre;
	}
	function setTelefono($telefonoCo){
		$this->telefono=$telefonoCo;
	}
	function getTelefono(){
		return $this->telefono;
	}	
	function setTipoCliente($tipoclienten){
		$this->tipocliente=$tipoclienten;
	}
	function getTipoCliente(){
		return $this->tipocliente;
	}
	function getLatitud(){
		return $this->lat;
	}
	function getLongitud(){
		return $this->long;
	}
	function setFechaRegistro($fres){
		$this->fecharegistro=$fres;
	}
	function getFechaRegistro(){
		return $this->fecharegistro;
	}
	function setFechaInactivo($fein){
		$this->fechainactivo=$fein;
	}
	function getFechaInactivo(){
		return $this->fechainactivo;
	}
	function setImagen($img){
		$this->imagen=$img;
	}
	function getImagen(){
		return $this->imagen;
	}
	function setEmail($ema){
		$this->email=$ema;
	}
	function getEmail(){
		return $this->email;
	}
	function setTopeCredito($tcre){
		$this->topecredito=$tcre;
	}
	function getTopeCredito(){
		return $this->topecredito;
	}
	function setIdUser($user){
		$this->idUser=$user;
	}
	function getIdUser(){
		return $this->idUser;
	}
}
?>