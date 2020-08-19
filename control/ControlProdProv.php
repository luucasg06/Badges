<?php
	class ControlProdProv{
		var $objPP;
		
		function __construct($objPP){
			$this->objPP=$objPP;
		}

		function guardar(){
			$mensaje="";
			$sv="localhost";
			$us="root";
			$ps="";
			$bd="bdproyectoa";
			$idPv=$this->objPP->getProveedor();
			$idPr=$this->objPP->getProducto();
			$cmdSql="INSERT INTO `proveedor_producto`(`idProveedor`, `idProducto`) VALUES ('".$idPv."','".$idPr."')";

			$cmdAux="SELECT * FROM proveedor WHERE idProveedor='".$idPv."'";
			$objControlConexion= new ControlConexion();
			$objControlConexion->abrirBd($sv,$us,$ps,$bd);
			$resultado=$objControlConexion->ejecutarSelect($cmdAux);
			$registro = $resultado->fetch_array(MYSQLI_BOTH);
	      	$idProveed=$registro["idProveedor"];

	      	$cmdAux="SELECT * FROM producto WHERE idProducto='".$idPr."'";
			$objControlConexion= new ControlConexion();
			$objControlConexion->abrirBd($sv,$us,$ps,$bd);
			$resultado=$objControlConexion->ejecutarSelect($cmdAux);
			$registro = $resultado->fetch_array(MYSQLI_BOTH);
	      	$idProduc=$registro["idProducto"];

			try{
				$objControlConexion= new ControlConexion();
				$objControlConexion->abrirBd($sv,$us,$ps,$bd);
				if($idProveed == $idPv && $idProduc == $idPr){
					$linea=$objControlConexion->ejecutarComandoSql($cmdSql);
					$mensaje="PRODUCTO AGREGADO EXITOSAMENTE";
				}else{
					$mensaje="DATOS ERRÓNEOS, INTENTE DE NUEVO";
				}
				$objControlConexion->cerrarBd();
				
			}
			catch(Exception $objExp){
				$mensaje=$objExp->getMessage();
			}
			return $mensaje;
		}
	}
?>