<?php
	class ControlAdmin{
		var $objAdmin;
		
		function __construct($objAdmin){
			$this->objAdmin=$objAdmin;
		}
		function  validarIngreso(){

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
		        $comandoSql="SELECT * FROM USUARIO  WHERE usuario='".$adm."' AND contrasena='".$con."' AND idPerfil='1'";
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
      }

     	function  validarIngresoClientes(){

			$sv="localhost";
			$us="root";
			$ps="";
			$bd="bdproyectoa";
	        $esValido=false;
	        $objAdmin2 = new Administrador ('','');
	      	$admi= $this->objAdmin->getNombre();
	     	$cont=$this->objAdmin->getContrasena();
	     	$objConexion1 = new ControlConexion();
	      	try{
		        $objConexion1->abrirBd($sv,$us,$ps,$bd);
		        $comandoSqlC="SELECT * FROM USUARIO  WHERE usuario='".$admi."' AND contrasena='".$cont."' AND idPerfil='3'";
		        $recordSet=$objConexion1->ejecutarSelect($comandoSqlC);
        		$registro = $recordSet->fetch_array(MYSQLI_BOTH);
		        $objAdmin2->setNombre($registro['usuario']);
		        $objAdmin2->setContrasena($registro['contrasena']);
		         
            }
          catch (Exception $e)
              {
             	 echo "ERROR ".$e->getMessage()."\n";
               }
            $objConexion1->cerrarBd();
			$nombr= $objAdmin2->getNombre();
            if($registro['usuario']) 
     		 {
              $esValido = true;
            }
            else
            {
              $esValido = false;
            }
      return $esValido;
      }
      function  validarIngresoEmpleados(){

			$sv="localhost";
			$us="root";
			$ps="";
			$bd="bdproyectoa";
	        $esValido=false;
	        $objAdmin2 = new Administrador ('','');
	      	$admi= $this->objAdmin->getNombre();
	     	$cont=$this->objAdmin->getContrasena();
	     	$objConexion1 = new ControlConexion();
	      	try{
		        $objConexion1->abrirBd($sv,$us,$ps,$bd);
		        $comandoSqlC="SELECT * FROM USUARIO  WHERE usuario='".$admi."' AND contrasena='".$cont."' AND idPerfil='2'";
		        $recordSet=$objConexion1->ejecutarSelect($comandoSqlC);
        		$registro = $recordSet->fetch_array(MYSQLI_BOTH);
		        $objAdmin2->setNombre($registro['usuario']);
		        $objAdmin2->setContrasena($registro['contrasena']);
		         
            }
          catch (Exception $e)
              {
             	 echo "ERROR ".$e->getMessage()."\n";
               }
            $objConexion1->cerrarBd();
			$nombr= $objAdmin2->getNombre();
            if($registro['usuario']) 
     		 {
              $esValido = true;
            }
            else
            {
              $esValido = false;
            }
      return $esValido;
      }
      function  validarIngresoProveedores(){

			$sv="localhost";
			$us="root";
			$ps="";
			$bd="bdproyectoa";
	        $esValido=false;
	        $objAdmin2 = new Administrador ('','');
	      	$admi= $this->objAdmin->getNombre();
	     	$cont=$this->objAdmin->getContrasena();
	     	$objConexion1 = new ControlConexion();
	      	try{
		        $objConexion1->abrirBd($sv,$us,$ps,$bd);
		        $comandoSqlC="SELECT * FROM USUARIO  WHERE usuario='".$admi."' AND contrasena='".$cont."' AND idPerfil='4'";
		        $recordSet=$objConexion1->ejecutarSelect($comandoSqlC);
        		$registro = $recordSet->fetch_array(MYSQLI_BOTH);
		        $objAdmin2->setNombre($registro['usuario']);
		        $objAdmin2->setContrasena($registro['contrasena']);
		         
            }
          catch (Exception $e)
              {
             	 echo "ERROR ".$e->getMessage()."\n";
               }
            $objConexion1->cerrarBd();
			$nombr= $objAdmin2->getNombre();
            if($registro['usuario']) 
     		 {
              $esValido = true;
            }
            else
            {
              $esValido = false;
            }
      return $esValido;
      }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		function guardar($tper){
			$mensaje="";
			$sv="localhost";
			$us="root";
			$ps="";
			$bd="bdproyectoa";
				$nU=$this->objAdmin->getNombre();
				$con=$this->objAdmin->getContrasena();		
				$tperfil=$tper;	
		
				$cmdSql="INSERT INTO USUARIO values('','".$nU."','".$con."','".$tperfil."')";

			try{

				$objControlConexion= new ControlConexion();
				$objControlConexion->abrirBd($sv,$us,$ps,$bd);
				$objControlConexion->ejecutarComandoSql($cmdSql);
				$objControlConexion->cerrarBd();
				$mensaje="REGISTRO GUARDADO EXITOSAMENTE";
			}
			catch(Exception $objExp){
				$mensaje=$objExp->getMessage();
			}
			return $mensaje;
		}
		function borrar(){
			$mensaje="";
			$sv="localhost";
			$us="root";
			$ps="";
			$bd="bdproyectoa";
				$nU=$this->objAdmin->getNombre();
				$con=$this->objAdmin->getContrasena();	
		
				$cmdSql="DELETE FROM USUARIO WHERE usuario='".$nU."' AND contrasena='".$con."'";

			try{

				$objControlConexion= new ControlConexion();
				$objControlConexion->abrirBd($sv,$us,$ps,$bd);
				$objControlConexion->ejecutarComandoSql($cmdSql);
				$objControlConexion->cerrarBd();
				$mensaje="REGISTRO ELIMINADO";
			}
			catch(Exception $objExp){
				$mensaje=$objExp->getMessage();
			}
			return $mensaje;			
		}

		function modificar($contran){
			$mensaje="";
			$sv="localhost";
			$us="root";
			$ps="";
			$bd="bdproyectoa";
				$nU=$this->objAdmin->getNombre();
				$con=$this->objAdmin->getContrasena();
				$ncontra=$contran;		
		
				$cmdSql="UPDATE USUARIO SET contrasena='".$ncontra."' WHERE usuario='".$nU."' AND contrasena='".$con."'";
				$cmdAux="SELECT contrasena FROM USUARIO WHERE usuario='".$nU."'";	
			try{
				$objControlConexion= new ControlConexion();
				$objControlConexion->abrirBd($sv,$us,$ps,$bd);
				$resultado=$objControlConexion->ejecutarSelect($cmdAux);
				$registro = $resultado->fetch_array(MYSQLI_BOTH);
        		$clave=$registro["contrasena"];
				if($clave==$con){
					$objControlConexion->ejecutarComandoSql($cmdSql);
					$mensaje="CONTRASEÑA MODIFICADA";
				}else{
					$mensaje="CONTRASEÑA ACTUAL INCORRECTA";
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