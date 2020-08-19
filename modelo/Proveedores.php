<?php
class Proveedores{
	var $nombre;
	var $tipoproveedor;
	var $fecharegistro;
	var $fechainactivo;
	var $imagen;
	var $email;
	var $telefono;
	var $idUser;
	var $lat;
	var $long;
	
	function __construct($nombreP,$tipoproveedorP,$fecharegistroP,$fechainactivoP,$imagenP,$emailP,$telefonoP,$idUserP,$latP,$longP){
		$this->nombre=$nombreP;
		$this->tipoproveedor=$tipoproveedorP;
		$this->fecharegistro=$fecharegistroP;
		$this->fechainactivo=$fechainactivoP;
		$this->imagen=$imagenP;
		$this->email=$emailP;
		$this->telefono=$telefonoP;
		$this->idUser=$idUserP;
		$this->lat=$latP;
		$this->long=$longP;
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
	function setTipoProveedor($tipoproveedorn){
		$this->tipoproveedor=$tipoproveedorn;
	}
	function getTipoProveedor(){
		return $this->tipoproveedor;
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
	function setIdUser($user){
		$this->idUser=$user;
	}
	function getIdUser(){
		return $this->idUser;
	}
	function setLat($lati){
		$this->lat=$lati;
	}
	function getLat(){
		return $this->lat;
	}
	function setLong($longi){
		$this->long=$longi;
	}
	function getLong(){
		return $this->long;
	}
}
?>