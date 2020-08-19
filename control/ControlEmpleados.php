<?php
  class ControlEmpleados{
    var $objEmpleados;
    
    function __construct($objEmpleados){
      $this->objEmpleados=$objEmpleados;
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
        $nU=$this->objEmpleados->getNombre();
        $fr=$this->objEmpleados->getFechaRegistro();
        $fi=$this->objEmpleados->getFechaInactivo();
        $sb=$this->objEmpleados->getSalarioB();
        $dd=$this->objEmpleados->getDeducciones();
        $im=$this->objEmpleados->getImagen();
        $hv=$this->objEmpleados->getHojaVida();
        $ema=$this->objEmpleados->getEmail();
        $tel=$this->objEmpleados->getTelefono();
        $cel=$this->objEmpleados->getCelular();
        $iu=$this->objEmpleados->getIdUser();  
        $lat=$this->objEmpleados->getLat();
        $long=$this->objEmpleados->getLong();
        
    
        $cmdSql="INSERT INTO empleado values('','".$nU."','".$fr."','".$fi."','".$sb."','".$dd."','".$im."','".$hv."','".$ema."','".$tel."','".$cel."','".$iu."','".$lat."','".$long."')";

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
      $idE=$this->objEmpleados->getIdUser();     
      $fi=$this->objEmpleados->getFechaInactivo();
      $cmdSql="UPDATE empleado SET fechaRetiro ='".$fi."' WHERE idUsuario='".$idE."'";
      $cmdAux="SELECT U.idUsuario, E.fechaIngreso, E.fechaRetiro FROM USUARIO U INNER JOIN EMPLEADO E ON U.idUsuario = E.idUsuario WHERE E.idUsuario='".$idE."' AND U.Idperfil = '2'";
      try{
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($sv,$us,$ps,$bd);
        $resultado = $objControlConexion->ejecutarSelect($cmdAux);
        $registro = $resultado->fetch_array(MYSQLI_BOTH);
        $idEm = $registro["idUsuario"];
        $retiro = $registro["fechaRetiro"];
        $ingreso = $registro["fechaIngreso"];
        $fechaR = Date($fi);
        $fechaI = Date($ingreso);
        if($idEm == $idE){
          if($retiro == "0000-00-00"){
            if($fechaI<=$fechaR){
              $objControlConexion->ejecutarComandoSql($cmdSql);
              $mensaje = "FECHA DE RETIRO MODIFICADA";
            }else{
              $mensaje = "INCONSISTENCIA: LA FECHA DE INGRESO NO PUEDE SER POSTERIOR A LA DE RETIRO| INGRESO:".$ingreso." RETIRO: ".$fi;
            }
          }else{
            $mensaje="EL EMPLEADO YA SE ENCUENTRA RETIRADO";
          }
        }else{
          $mensaje = "Datos erróneos, vuelva a intentar";
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
      $idE=$this->objEmpleados->getIdUser(); 
      if($num=='1'){
        $nE=$this->objEmpleados->getNombre();
        $cmdSql="UPDATE empleado SET nombre ='".$nE."' WHERE idUsuario='".$idE."'";
        $mensaje="NOMBRE MODIFICADO";
      }else{
        if($num=='2'){
          $fr=$this->objEmpleados->getFechaRegistro();
          $cmdSql="UPDATE empleado SET fechaIngreso ='".$fr."' WHERE idUsuario='".$idE."'";
          $mensaje="FECHA DE INGRESO MODIFICADA";
        }else{
          if($num=='3'){
            $sb=$this->objEmpleados->getSalarioB();
            $cmdSql="UPDATE empleado SET salarioBasico='".$sb."' WHERE idUsuario='".$idE."'";
            $mensaje="SALARIO BÁSICO MODIFICADO";
          }else{
            if($num=='4'){
              $dd=$this->objEmpleados->getDeducciones();
              $cmdSql="UPDATE empleado SET deducciones='".$dd."' WHERE idUsuario='".$idE."'";
              $mensaje="DEDUCCION MODIFICADA";
            }else{
              if($num=='5'){
                $ema=$this->objEmpleados->getEmail();
                $cmdSql="UPDATE empleado SET email='".$ema."' WHERE idUsuario='".$idE."'";
                $mensaje="EMAIL MODIFICADO";
              }else{
                if($num=='6'){
                  $tel=$this->objEmpleados->getTelefono();
                  $cmdSql="UPDATE empleado SET telefono='".$tel."' WHERE idUsuario='".$idE."'";
                  $mensaje="TELÉFONO MODIFICADO";
                }else{
                  if($num=='7'){
                    $cel=$this->objEmpleados->getCelular();
                    $cmdSql="UPDATE empleado SET movil='".$cel."' WHERE idUsuario='".$idE."'";
                    $mensaje="CELULAR MÓVIL MODIFICADO";
                  }else{
                    if($num=='8'){
                      $im=$this->objEmpleados->getImagen();
                      $cmdSql="UPDATE empleado SET foto='".$im."' WHERE idUsuario='".$idE."'";
                      $mensaje="FOTO MODIFICADA";
                    }else{
                      if($num=='9'){
                        $hv=$this->objEmpleados->getHojaVida();
                        $cmdSql="UPDATE empleado SET hojaV='".$hv."' WHERE idUsuario='".$idE."'";
                        $mensaje="HOJA DE VIDA MODIFICADA";
                      }
                    }
                  }
                } 
              }
            }
          }
        }    
      } 
      $cmdAux="SELECT idUsuario FROM USUARIO WHERE idUsuario='".$idE."' AND Idperfil = '2'";
      try{
        $objControlConexion= new ControlConexion();
        $objControlConexion->abrirBd($sv,$us,$ps,$bd);
        $resultado=$objControlConexion->ejecutarSelect($cmdAux);
        $registro = $resultado->fetch_array(MYSQLI_BOTH);
        $idEm=$registro["idUsuario"];
        if($idEm==$idE){
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