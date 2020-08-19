<?php
class Empleados{
	var $nombre;
	var $fecharegistro;
	var $fechainactivo;
	var $salariobasico;
	var $deducciones;
	var $imagen;
	var $hojadevida;
	var $email;
	var $telefono;
	var $celular;
	var $idUser;
	var $lat;
	var $long;

	
	function __construct($nombreE,$fecharegistroE,$fechainactivoE,$salariobasicoE,$deduccionesE,$imagenE,$hojadevidaE,$emailE,$telefonoE,$celularE,$idUserE,$latE,$longE){
		$this->nombre=$nombreE;
		$this->fecharegistro=$fecharegistroE;
		$this->fechainactivo=$fechainactivoE;
		$this->salariobasico=$salariobasicoE;
		$this->deducciones=$deduccionesE;
		$this->imagen=$imagenE;
		$this->hojadevida=$hojadevidaE;
		$this->email=$emailE;
		$this->telefono=$telefonoE;
		$this->celular=$celularE;
		$this->idUser=$idUserE;
		$this->lat=$latE;
		$this->long=$longE;
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
	function setSalarioB($salbas){
		$this->salariobasico=$salbas;
	}
	function getSalarioB(){
		return $this->salariobasico;
	}
	function setDeducciones($deducc){
		$this->deducciones=$deducc;
	}
	function getDeducciones(){
		return $this->deducciones;
	}
	function setImagen($img){
		$this->imagen=$img;
	}
	function getImagen(){
		return $this->imagen;
	}
	function setHojaVida($hv){
		$this->hojadevida=$hv;
	}
	function getHojaVida(){
		return $this->hojadevida;
	}
	function setEmail($ema){
		$this->email=$ema;
	}
	function getEmail(){
		return $this->email;
	}
	function setCelular($celu){
		$this->celular=$celu;
	}
	function getCelular(){
		return $this->celular;
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