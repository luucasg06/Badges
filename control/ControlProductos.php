<?php
	class ControlProductos{
		var $objProductos;
		
		function __construct($objProductos){
			$this->objProductos=$objProductos;
		}

		function guardar(){
			$mensaje="";
			$sv="localhost";
			$us="root";
			$ps="";
			$bd="bdproyectoa";
			$nU=$this->objProductos->getNombre();
			$im=$this->objProductos->getImagen();
		
			$cmdSql="INSERT INTO producto (nombre,foto) values('".$nU."','".$im."')";

			try{
				$objControlConexion= new ControlConexion();
				$objControlConexion->abrirBd($sv,$us,$ps,$bd);
				$objControlConexion->ejecutarComandoSql($cmdSql);
				$objControlConexion->cerrarBd();
				$mensaje="Producto Guardado Exitosamente";
			}
			catch(Exception $objExp){
				$mensaje=$objExp->getMessage();
			}
			return $mensaje;
		}
		
	function desactivar(){
      $mensaje="";
      $sv="localhost";
      $us="root";
      $ps="";
      $bd="bdproyectoa";
      $idC=$this->objClientes->getIdUser();     
      $fi=$this->objClientes->getFechaInactivo();
      $cmdSql="UPDATE cliente SET fechaInactivo ='".$fi."' WHERE idUsuario='".$idC."'";
      $cmdAux="SELECT U.idUsuario, C.fechaRegistro, C.fechaInactivo FROM USUARIO U INNER JOIN CLIENTE C ON U.idUsuario = C.idUsuario WHERE C.idUsuario='".$idC."' AND U.Idperfil = '3'";
      try{
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($sv,$us,$ps,$bd);
        $resultado = $objControlConexion->ejecutarSelect($cmdAux);
        $registro = $resultado->fetch_array(MYSQLI_BOTH);
        $idCl = $registro["idUsuario"];
        $retiro = $registro["fechaInactivo"];
        $ingreso = $registro["fechaRegistro"];
        $fechaR = Date($fi);
        $fechaI = Date($ingreso);
        if($idCl == $idC){
          if($retiro == "0000-00-00"){
            if($fechaI<=$fechaR){
              $objControlConexion->ejecutarComandoSql($cmdSql);
              $mensaje = "FECHA DE RETIRO MODIFICADA";
            }else{
              $mensaje = "INCONSISTENCIA: LA FECHA DE INGRESO NO PUEDE SER POSTERIOR A LA DE RETIRO| INGRESO:".$ingreso." RETIRO: ".$fi;
            }
          }else{
            $mensaje="EL CLIENTE YA SE ENCUENTRA RETIRADO";
          }
        }else{
          $mensaje = "DATOS ERRÓNEOS, VUELVA A INTENTAR";
        }
        $objControlConexion->cerrarBd();
      }
      catch(Exception $objExp){
        $mensaje=$objExp->getMessage();
      }
      return $mensaje;      
    }

	function modificar($num,$idP){
		$mensaje="";
		$sv="localhost";
		$us="root";
		$ps="";
		$bd="bdproyectoa";
		if($num=='1'){
			$nP=$this->objProductos->getNombre();
	       	$cmdSql="UPDATE producto SET nombre ='".$nP."' WHERE idProducto='".$idP."'";
	       	$mensaje="NOMBRE MODIFICADO";	
		}else{
			if($num=='2'){
				$im=$this->objProductos->getImagen();
	            $cmdSql="UPDATE producto SET foto ='".$im."' WHERE idProducto='".$idP."'";
	            $mensaje="FOTO MODIFICADA";
			}
		}	
		$cmdAux="SELECT * FROM producto WHERE idProducto='".$idP."'";
		try{
			$objControlConexion= new ControlConexion();
			$objControlConexion->abrirBd($sv,$us,$ps,$bd);
			$resultado=$objControlConexion->ejecutarSelect($cmdAux);
			$registro = $resultado->fetch_array(MYSQLI_BOTH);
	      	$idPr=$registro["idProducto"];
	      	if($idPr==$idP){
				$objControlConexion->ejecutarComandoSql($cmdSql);
			}else{
				$mensaje="DATOS ERRÓNEOS, VUELVA A INTENTAR";
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
