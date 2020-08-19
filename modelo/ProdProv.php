<?php
class ProdProv{
	var $idProducto;
	var $idProveedor;
	
	function __construct($idProveedorC,$idProductoC){
		$this->idProveedor=$idProveedorC;
		$this->idProducto=$idProductoC;
	}
	function setProveedor($prov){
		$this->idProveedor=$prov;
	}
	function getProveedor(){
		return $this->idProveedor;
	}
	function setProducto($prod){
		$this->idProducto=$prod;
	}
	function getProducto(){
		return $this->idProducto;
	}
}
?>