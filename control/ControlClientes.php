<?php
	class ControlClientes{
		var $objClientes;
		
		function __construct($objClientes){
			$this->objClientes=$objClientes;
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
				$nU=$this->objClientes->getNombre();
				$tcli=$this->objClientes->getTipoCliente();	
				$fr=$this->objClientes->getFechaRegistro();
				$fi=$this->objClientes->getFechaInactivo();
				$im=$this->objClientes->getImagen();
				$ema=$this->objClientes->getEmail();
				$tel=$this->objClientes->getTelefono();
				$tc=$this->objClientes->getTopeCredito();
				$iu=$this->objClientes->getIdUser();
				$lat=$this->objClientes->getLatitud();
				$long=$this->objClientes->getLongitud();	
				
		
				$cmdSql="INSERT INTO cliente values('','".$nU."','".$tcli."','".$fr."','".$fi."','".$im."','".$ema."','".$tel."','".$tc."','".$iu."','".$lat."','".$long."')";

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

	function modificar($num){
		$mensaje="";
		$sv="localhost";
		$us="root";
		$ps="";
		$bd="bdproyectoa";
		$idC=$this->objClientes->getIdUser();
		if($num=='1'){
			$nC=$this->objClientes->getNombre();
	       	$cmdSql="UPDATE cliente SET nombre ='".$nC."' WHERE idUsuario='".$idC."'";
	       	$mensaje="NOMBRE MODIFICADO";	
		}else{
			if($num=='2'){
				$tcli=$this->objClientes->getTipoCliente();
				$cmdSql="UPDATE cliente SET tipo ='".$tcli."' WHERE idUsuario='".$idC."'";
				$mensaje="EL USUARIO AHORA ES CLIENTE: ".$tcli;
			}else{
				if($num=='3'){
					$fr=$this->objClientes->getFechaRegistro();
					$cmdSql="UPDATE cliente SET fechaRegistro='".$fr."' WHERE idUsuario='".$idC."'";
			        $mensaje="FECHA DE INGRESO MODIFICADA";
				}else{
					if($num=='4'){
						$im=$this->objClientes->getImagen();
	                   	$cmdSql="UPDATE cliente SET mapImagen='".$im."' WHERE idUsuario='".$idC."'";
	                   	$mensaje="FOTO MODIFICADA";
					}else{
						if($num=='5'){
							$emailC=$this->objClientes->getEmail();
							$cmdSql="UPDATE cliente SET email='".$emailC."' WHERE idUsuario='".$idC."'";
							$mensaje="EMAIL MODIFICADO";
						}else{
							if($num=='6'){
								$telC=$this->objClientes->getTelefono();
								$cmdSql="UPDATE cliente SET telefono='".$telC."' WHERE idUsuario='".$idC."'";
								$mensaje="TELÉFONO MODIFICADO";
							}else{
								if($num=='7'){
									$credC=$this->objClientes->getTopeCredito();
									$cmdSql="UPDATE cliente SET topeCredito='".$credC."' WHERE idUsuario='".$idC."'";
									$mensaje="TOPE DE CRÉDITO MODIFICADO";
								}
							}
						}
					}
				}	
			}
		}	
		$cmdAux="SELECT idUsuario FROM USUARIO WHERE idUsuario='".$idC."' AND Idperfil = '3'";
		try{
			$objControlConexion= new ControlConexion();
			$objControlConexion->abrirBd($sv,$us,$ps,$bd);
			$resultado=$objControlConexion->ejecutarSelect($cmdAux);
			$registro = $resultado->fetch_array(MYSQLI_BOTH);
	      	$idCl=$registro["idUsuario"];
	      	if($idCl==$idC){
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
