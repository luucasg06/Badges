<?php
	class ControlProveedores{
		var $objProveedores;
		
		function __construct($objProveedores){
			$this->objProveedores=$objProveedores;
		}
		/*function  validarIngreso(){

			$sv="localhost";
			$us="root";
			$ps="";
			$bd="bdproyectoa";
	        $esValido=false;
	        $objAdmin1 = new Administrador ('','');
	      	$adm= $this->objAdmin->getNombre();
	     	$con=$this->objAdmin->getContrasena();
	     	$objConexion = new ControlConexion();
	      	try{
		        $objConexion->abrirBd($sv,$us,$ps,$bd);
		        $comandoSql="SELECT * FROM USUARIO  WHERE usuario='".$adm."' AND contrasena='".$con."'";
		        $recordSet=$objConexion->ejecutarSelect($comandoSql);
        		$registro = $recordSet->fetch_array(MYSQLI_BOTH);
		        $objAdmin1->setNombre($registro['usuario']);
		        $objAdmin1->setContrasena($registro['contrasena']);
		         
            }
          catch (Exception $e)
              {
             	 echo "ERROR ".$e->getMessage()."\n";
               }
            $objConexion->cerrarBd();
			$nomb= $objAdmin1->getNombre();
            if($registro['usuario']) 
     		 {
              $esValido = true;
            }
            else
            {
              $esValido = false;
            }
      return $esValido;
      }*/
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function guardar(){
		$mensaje="";
		$sv="localhost";
		$us="root";
		$ps="";
		$bd="bdproyectoa";
		$nU=$this->objProveedores->getNombre();
		$tpro=$this->objProveedores->getTipoProveedor();	
		$fr=$this->objProveedores->getFechaRegistro();
		$fi=$this->objProveedores->getFechaInactivo();
		$im=$this->objProveedores->getImagen();
		$ema=$this->objProveedores->getEmail();
		$tel=$this->objProveedores->getTelefono();
        $iu=$this->objProveedores->getIdUser();  
		$lat=$this->objProveedores->getLat();
        $long=$this->objProveedores->getLong();
			
		
		$cmdSql="INSERT INTO proveedor values('','".$nU."','".$tpro."','".$fr."','".$fi."','".$im."','".$ema."','".$tel."','".$iu."','".$lat."','".$long."')";

		try{
			$objControlConexion= new ControlConexion();
			$objControlConexion->abrirBd($sv,$us,$ps,$bd);
			$objControlConexion->ejecutarComandoSql($cmdSql);
			$objControlConexion->cerrarBd();
			$mensaje="Registro Guardado Exitosamente";
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
      $idP=$this->objProveedores->getIdUser();    
      $fi=$this->objProveedores->getFechaInactivo();
      $cmdSql="UPDATE proveedor SET fechaInactivo ='".$fi."' WHERE idUsuario='".$idP."'";
      $cmdAux="SELECT U.idUsuario, P.fechaRegistro, P.fechaInactivo FROM USUARIO U INNER JOIN PROVEEDOR P ON U.idUsuario = P.idUsuario WHERE P.idUsuario='".$idP."' AND U.Idperfil = '4'";
      try{
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($sv,$us,$ps,$bd);
        $resultado = $objControlConexion->ejecutarSelect($cmdAux);
        $registro = $resultado->fetch_array(MYSQLI_BOTH);
        $idPr = $registro["idUsuario"];
        $retiro = $registro["fechaInactivo"];
        $ingreso = $registro["fechaRegistro"];
        $fechaR = Date($fi);
        $fechaI = Date($ingreso);
        if($idPr == $idP){
          if($retiro == "0000-00-00"){
            if($fechaI<=$fechaR){
              $objControlConexion->ejecutarComandoSql($cmdSql);
              $mensaje = "FECHA DE RETIRO MODIFICADA";
            }else{
              $mensaje = "INCONSISTENCIA: LA FECHA DE INGRESO NO PUEDE SER POSTERIOR A LA DE RETIRO| INGRESO:".$ingreso." RETIRO: ".$fi;
            }
          }else{
            $mensaje="EL PROVEEDOR YA SE ENCUENTRA RETIRADO";
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

	function modificar($num){
		$mensaje="";
		$sv="localhost";
		$us="root";
		$ps="";
		$bd="bdproyectoa";
		$idP=$this->objProveedores->getIdUser();
		if($num=='1'){
			$nP=$this->objProveedores->getNombre();
	       	$cmdSql="UPDATE proveedor SET nombre ='".$nP."' WHERE idUsuario='".$idP."'";
	       	$mensaje="NOMBRE MODIFICADO";	
		}else{
			if($num=='2'){
				$tpro=$this->objProveedores->getTipoProveedor();
				$cmdSql="UPDATE proveedor SET tipo ='".$tpro."' WHERE idUsuario='".$idP."'";
				$mensaje="EL USUARIO AHORA ES CLIENTE: ".$tpro;
			}else{
				if($num=='3'){
					$fr=$this->objProveedores->getFechaRegistro();
					$cmdSql="UPDATE proveedor SET fechaRegistro='".$fr."' WHERE idUsuario='".$idP."'";
			        $mensaje="FECHA DE INGRESO MODIFICADA";
				}else{
					if($num=='4'){
						$im=$this->objProveedores->getImagen();
	                   	$cmdSql="UPDATE proveedor SET foto='".$im."' WHERE idUsuario='".$idP."'";
	                   	$mensaje="FOTO MODIFICADA";
					}else{
						if($num=='5'){
							$emailP=$this->objProveedores->getEmail();
							$cmdSql="UPDATE proveedor SET email='".$emailP."' WHERE idUsuario='".$idP."'";
							$mensaje="EMAIL MODIFICADO";
						}else{
							if($num=='6'){
								$telP=$this->objProveedores->getTelefono();
								$cmdSql="UPDATE proveedor SET telefono='".$telP."' WHERE idUsuario='".$idP."'";
								$mensaje="TELÉFONO MODIFICADO";
							}
						}
					}
				}	
			}
		}	
		$cmdAux="SELECT idUsuario FROM USUARIO WHERE idUsuario='".$idP."' AND Idperfil = '4'";
		try{
			$objControlConexion= new ControlConexion();
			$objControlConexion->abrirBd($sv,$us,$ps,$bd);
			$resultado=$objControlConexion->ejecutarSelect($cmdAux);
			$registro = $resultado->fetch_array(MYSQLI_BOTH);
	      	$idPr=$registro["idUsuario"];
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

/*
$fr=$this->objClientes->getFechaRegistro();
					$cmdSql="UPDATE cliente SET fechaRegistro='".$fr."' WHERE idUsuario='".$idC."'";
					$cmdAux="SELECT U.idUsuario, C.fechaRegistro, C.fechaInactivo FROM USUARIO U INNER JOIN CLIENTE C ON U.idUsuario = C.idUsuario WHERE C.idUsuario='".$idC."' AND U.Idperfil = '3'";
					$objControlConexion = new ControlConexion();
			        $objControlConexion->abrirBd($sv,$us,$ps,$bd);
			        $resultado = $objControlConexion->ejecutarSelect($cmdAux);
			        $registro = $resultado->fetch_array(MYSQLI_BOTH);
			        $idCl = $registro["idUsuario"];
			        $retiro = $registro["fechaInactivo"];
			        $ingreso = $registro["fechaRegistro"];
			        $fechaR = Date($fr);
			        $fechaI = Date($ingreso);
			        $fechActual=date("Y-m-d");
			        $hoy = Date($fechActual);
			        if($idCl == $idC){
			          if($retiro == "0000-00-00"){
			          	if($fechaI<=$hoy){
			          		//$objControlConexion->ejecutarComandoSql($cmdSql);
			            	//$mensaje="FECHA DE INGRESO MODIFICADA";
			            	$mensaje="SI ES HOY".$hoy."/".$fr;
			          	}else{
			          		$mensaje="LA FECHA DE INGRESO ".$fr." NO PUEDE SER POSTERIOR A LA ACTUAL - ".$hoy;
			          	}
			          }else{
			            if($fechaI<=$fechaR){
			              	//$objControlConexion->ejecutarComandoSql($cmdSql);
			            	//$mensaje="FECHA DE INGRESO MODIFICADA";
			            	$mensaje="YA SE RETIRO";
			            }else{
			              $mensaje = "INCONSISTENCIA: LA FECHA DE INGRESO NO PUEDE SER POSTERIOR A LA DE RETIRO| INGRESO:".$ingreso." RETIRO: ".$fi;
			            }
			          }
			        }else{
			          $mensaje = "DATOS ERRÓNEOS, VUELVA A INTENTAR";
			        }
*/

?>
