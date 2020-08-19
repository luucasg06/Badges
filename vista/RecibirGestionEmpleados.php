<?php 
include('../modelo/Empleados.php');
include('../control/ControlEmpleados.php');
include('../control/ControlConexion.php');
 
session_start();
if(isset($_SESSION["Usu"])){
 $usuario=$_SESSION["Usu"]; 
}else if(isset($_SESSION["Cli"])){
 header("Location: HomeClientes.php");
}else if(isset($_SESSION["UsuProv"])){
 header("Location: HomeProveedor.php");
}else if(isset($_SESSION["UsuEmp"])){
 header("Location: HomeEmpleado.php");
}else{
 header("Location: ../index.html");
}
 
?>
<!DOCTYPE html>
<html>

<head>
  <title>Gestión Total: Respuesta Gestión Empleados</title>
 <link rel="icon" type="image/png" href="../estilos/images/icons/IgestionV2.ico"/>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <link type="text/css" rel="stylesheet" href="../estilos/css/materialize.min.css" media="screen,projection" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../estilos/css/Estilos_2.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/>
  <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
   integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
   crossorigin=""></script>
  <meta charset="utf-8">
</head>

<body>
    
  <div class="container">

    <!-- Menu lateral-->
          <a href="#" class="sidenav-trigger" data-target="menu-side">
          <i class="medium material-icons">menu</i>
        </a>
        <ul class="sidenav sidenav-fixed" id="menu-side">
          <li>
            <div class="user-view">
              <div class="background">
               <img src="../estilos/images/GestionL.png" height="180" width="300">
               </div>
             <br/>
             <br/>
                &nbsp;
               <li><div class="divider"></div></li>
              <li id="Opciones"><a class=" waves-effect waves-teal" href="GestionUsuarios.php"><i class="material-icons">account_box</i>Administración de usuarios</a></li>
              <li><div class="divider"></div></li>
              <li id="Opciones"><a  class=" waves-effect waves-teal" href="GestionClientes.php"><i class="material-icons">assignment_ind</i>Gestión de clientes</a></li>
              <li><div class="divider"></div></li>
              <li id="Opciones"><a class=" waves-effect waves-teal" href="GestionEmpleados.php"><i class="material-icons">contacts</i>Gestión de empleados </a></li>
              <li><div class="divider"></div></li>
              <li id="Opciones"><a class=" waves-effect waves-teal" href="GestionProveedores.php"><i class="material-icons">face</i>Gestión proveedores</a></li>
              <li><div class="divider"></div></li>
              <li  id="Opciones"><a  class=" waves-effect waves-teal" href="GestionProductos.php"><i class="material-icons">widgets</i>Gestión de productos</a></li>
              <li><div class="divider"></div></li>
              <li id="Opciones"><a  class=" waves-effect waves-teal" href="GestionConsultas.php"><i class="material-icons">search</i>Consultas</a></li>
              <li><div class="divider"></div></li>
             <li id="Opciones"><a  class=" waves-effect waves-teal" href="Solicitudes.php"><i class="material-icons">assignment_turned_in</i>Solicitudes</a></li>
              <li><div class="divider"></div></li>
              <li id="Opciones"><a style="color: red" class=" waves-effect waves-teal" href="cerrarSession.php"><i class="material-icons">power_settings_new</i>Cerrar Sesión</a></li>
              <li><div class="divider"></div></li>
               
               </div>
          </li>
        </ul>
    <!-- Fin menu lateral-->


   <div class="row center">
      
      <div class="col s2 m1 l3"> <!-- Espacio del menú rejilla lado izquierdo--></div>
      <div class="col s10 m8 l0"> <!-- información en el centro -->
          <div> 
            <h4 style="color: green">RESULTADO DE SOLICITUD</h4>
<?php 
          
         
          $boton=$_POST['boton'];

          switch($boton){
          
            case 'REGISTRAR':
            $nom=$_POST['nombre'];
            $fre=$_POST['fechaR'];
            $fina=$_POST['fechaI'];
            $salb=$_POST['salB'];
            $deduc=$_POST['deduc'];
            $mail=$_POST['email'];
            $tele=$_POST['Tele'];
            $celu=$_POST['cel'];
            $IdU=$_POST['hola'];
            $lat=$_POST['lat'];
            $long=$_POST['long'];
 
                if(!(empty($_FILES['archivo']['name']['1']) || empty($_FILES['archivo']['name']['0']))){
                  $ruta0="empleados/".$IdU."/".$_FILES['archivo']['name']['0'];
                  $ruta1="empleados/".$IdU."/".$_FILES['archivo']['name']['1'];
               
                  if(file_exists($ruta0)||file_exists($ruta1)){
                    echo "ERROR ARCHIVO EXISTENTE";
                    die();
                  }else{
                    $tmp1=$_FILES['archivo']['tmp_name']['0'];
                    $tmp2=$_FILES['archivo']['tmp_name']['1'];
                    if(!(file_exists($ruta0) && (file_exists($ruta1)))) {
                      $ruta2 = "empleados/".$IdU."/";
                      mkdir($ruta2, 0777, true);
                    }
                    move_uploaded_file($tmp1,$ruta0);
                    move_uploaded_file($tmp2,$ruta1);
                    /*MOVIEMIENTO DE LA IMAGEN*/
                    $objEmpleados= new Empleados($nom,$fre,$fina,$salb,$deduc,$ruta0,$ruta1,$mail,$tele,$celu,$IdU,$lat,$long);
                    $objControlEmpleados = new ControlEmpleados($objEmpleados);
                    $msg=$objControlEmpleados->guardar(); 
                    $Sql="SELECT empleado.nombre, usuario.usuario, usuario.contrasena from empleado inner JOIN usuario on empleado.idUsuario=usuario.idUsuario where usuario.idUsuario='".$IdU."';";
                    $conexion=mysqli_connect('localhost', 'root','', 'bdproyectoa');
                    $resultadoq=mysqli_query($conexion,$Sql);
                     echo "<font size=20>REGISTRO GUARDADO Y ARCHIVO REGISTRADO </font>";
                    ?>
                      <center>
                      <table class="tc">
                          <tr>
                            <th>NOMBRE</th>
                            <th>USUARIO DE ACCESO</th>
                            <th>CLAVE DE ACCESO</th>
                          </tr>
                      <?php 
                       while($resultadosq=mysqli_fetch_array($resultadoq)){
                      ?>
                          <tr>
                            <td><?php echo $resultadosq['nombre'] ?></td>
                            <td><?php echo $resultadosq['usuario'] ?></td>
                            <td><?php echo $resultadosq['contrasena'] ?></td>
                            
                          </tr>

                      <?php
                      } 
                      ?>
                      </table>
                      </center>
                      <?php
                      mysqli_close($conexion); 
                 
                   }
              }
                  
              break;
              case 'CONSULTAR':
              $nom=$_POST['nombre'];
              $objEmpleados= new Empleados($nom,"","","","","","","","","","","","");
              $objControlEmpleados= new ControlEmpleados($objEmpleados);

              $Sql="SELECT * FROM empleado WHERE nombre LIKE '".$nom."%'";
              
              $conexion=mysqli_connect('localhost', 'root','', 'bdproyectoa');
              $resultadoCC=mysqli_query($conexion,$Sql);
              ?>
              <center>
              <table class="tc3">
                  <tr>
                    <th><center>NOMBRE</center></th>
                    <th><center>FECHA DE INGRESO</center></th>
                    <th><center>FECHA DE RETIRO</center></th>
                    <th><center>SALARIO</center> </th>
                    <th><center>DEDUCCIONES</center></th>
                    <th><center>EMAIL</center></th>
                    <th><center>FIJO</center></th>
                    <th><center>CELULAR</center></th>
                    <th><center>FOTO</center></th>
                    <th colspan="2"><center>HOJA DE VIDA</center></th>
                    <th>UBICACION</th>
                  

                  </tr>
              <?php 
               while($resultadosC=mysqli_fetch_array($resultadoCC)){
                if($resultadosC['fechaRetiro'] == "0000-00-00"){
                  $retiro = 'Activo';
                }else{
                  $retiro = $resultadosC['fechaRetiro'];
                }
              ?>
                  <tr>
                    <td><center><?php echo $resultadosC['nombre'] ?></center></td>
                    <td><center><?php echo $resultadosC['fechaIngreso'] ?></center></td>
                    <td><center><?php echo $retiro ?></center></td>
                    <td><center><?php echo $resultadosC['salarioBasico'] ?></center></td>
                    <td><center><?php echo $resultadosC['deducciones'] ?></center></td>
                    <td><center><?php echo $resultadosC['email'] ?></center></td>
                    <td><center><?php echo $resultadosC['telefono'] ?></center></td>
                    <td><center><?php echo $resultadosC['movil'] ?></center></td>
                    <td><center><?php echo "<img height=\"70\" width=\"70\" src=\"".$resultadosC['foto']."\"" ?></center></center></td>
                    <td><center><?php echo "<a href=\"".$resultadosC['hojaV']."\" target=\"_blank\" >Ver</a>" ?></center></td>
                    <td><center><?php echo "<a href=\"".$resultadosC['hojaV']."\"  download=\"".$resultadosC['hojaV']."\" >Descargar</a>" ?></center></td>
                    <td> <form action="./Ubicaciones.php" method="get" target="_blank">
                    <input type="hidden" name="lati" id="lati" value="<?php echo $resultadosC['Latitud'] ?>">
                    <input type="hidden" name="long" id="long" value="<?php echo $resultadosC['longitud'] ?>">
                    <input class="boton" type="submit" value= "Ubicar" >
                    </td>
                  </tr>

              <?php
              } 
              ?>
              </table></center>
              <?php 
              break;

              case 'CONSULTARTODOS':
              $nom=$_POST['nombre'];
              $objEmpleados= new Empleados($nom,"","","","","","","","","","","","");
              $objControlEmpleados= new ControlEmpleados($objEmpleados);

              $Sql="SELECT * FROM empleado";
              
              $conexion=mysqli_connect('localhost', 'root','', 'bdproyectoa');
              $resultadoCC=mysqli_query($conexion,$Sql);
              ?>
              <center>
              <table class="tc3">
                  <tr>
                    <th><center>NOMBRE</center></th>
                    <th><center>FECHA DE INGRESO</center></th>
                    <th><center>FECHA DE RETIRO</center></th>
                    <th><center>SALARIO</center> </th>
                    <th><center>DEDUCCIONES</center></th>
                    <th><center>EMAIL</center></th>
                    <th><center>FIJO</center></th>
                    <th><center>CELULAR</center></th>
                    <th><center>FOTO</center></th>
                    <th colspan="2"><center>HOJA DE VIDA</center></th>
                    <th>UBICACION</th>
                  

                  </tr>
              <?php 
               while($resultadosC=mysqli_fetch_array($resultadoCC)){
                if($resultadosC['fechaRetiro'] == "0000-00-00"){
                  $retiro = 'Activo';
                }else{
                  $retiro = $resultadosC['fechaRetiro'];
                }
              ?>
                  <tr>
                    <td><center><?php echo $resultadosC['nombre'] ?></center></td>
                    <td><center><?php echo $resultadosC['fechaIngreso'] ?></center></td>
                    <td><center><?php echo $retiro ?></center></td>
                    <td><center><?php echo $resultadosC['salarioBasico'] ?></center></td>
                    <td><center><?php echo $resultadosC['deducciones'] ?></center></td>
                    <td><center><?php echo $resultadosC['email'] ?></center></td>
                    <td><center><?php echo $resultadosC['telefono'] ?></center></td>
                    <td><center><?php echo $resultadosC['movil'] ?></center></td>
                    <td><center><?php echo "<img height=\"70\" width=\"70\" src=\"".$resultadosC['foto']."\"" ?></center></center></td>
                    <td><center><?php echo "<a href=\"".$resultadosC['hojaV']."\" target=\"_blank\" >Ver</a>" ?></center></td>
                    <td><center><?php echo "<a href=\"".$resultadosC['hojaV']."\"  download=\"".$resultadosC['hojaV']."\" >Descargar</a>" ?></center></td>
                    <td> <form action="./Ubicaciones.php" method="get" target="_blank">
                    <input type="hidden" name="lati" id="lati" value="<?php echo $resultadosC['Latitud'] ?>">
                    <input type="hidden" name="long" id="long" value="<?php echo $resultadosC['longitud'] ?>">
                    <input class="boton" type="submit" value= "Ubicar" >
                    </td>
                  </tr>

              <?php
              } 
              ?>
              </table></center>
              <?php 
              break;
              case 'MODIFICAR-NOMBRE':
                  $idE=$_POST['idEmpleado'];
                  $nomE=$_POST['nombreE'];
                  $objEmpleados = new Empleados($nomE,"","","","","","","","","",$idE);
                  $objControlEmpleados = new ControlEmpleados($objEmpleados);
                  $msg=$objControlEmpleados->modificar('1');  
                  echo "<font size=20>$msg</font>";
                  //echo "<script>alert('Mensaje');</script>";
              break;
              case 'MODIFICAR-INGRESO':
                  $idE=$_POST['idEmpleado'];
                  $ingresoE=$_POST['ingresoE'];
                  $objEmpleados = new Empleados("",$ingresoE,"","","","","","","","",$idE);
                  $objControlEmpleados = new ControlEmpleados($objEmpleados);
                  $msg=$objControlEmpleados->modificar('2');  
                  echo "<font size=20>$msg</font>";
                  //echo "<script>alert('Mensaje');</script>";
              break;
              case 'MODIFICAR-SALARIO':
                  $idE=$_POST['idEmpleado'];
                  $salE=$_POST['salE'];
                  $objEmpleados = new Empleados("","","",$salE,"","","","","","",$idE);
                  $objControlEmpleados = new ControlEmpleados($objEmpleados);
                  $msg=$objControlEmpleados->modificar('3');  
                  echo "<font size=20>$msg</font>";
                  //echo "<script>alert('Mensaje');</script>";
              break;
              case 'MODIFICAR-DEDUCCION':
                  $idE=$_POST['idEmpleado'];
                  $deduc=$_POST['deducE'];
                  $objEmpleados = new Empleados("","","","",$deduc,"","","","","",$idE);
                  $objControlEmpleados = new ControlEmpleados($objEmpleados);
                  $msg=$objControlEmpleados->modificar('4'); 
                  echo "<font size=20>$msg</font>";
                  //echo "<script>alert('Mensaje');</script>";
              break;
              case 'MODIFICAR-EMAIL':
                  $idE=$_POST['idEmpleado'];
                  $emailE=$_POST['emailE'];
                  $objEmpleados = new Empleados("","","","","","","",$emailE,"","",$idE);
                  $objControlEmpleados = new ControlEmpleados($objEmpleados);
                  $msg=$objControlEmpleados->modificar('5');  
                  echo "<font size=20>$msg</font>";
                  //echo "<script>alert('Mensaje');</script>";
              break;
              case 'MODIFICAR-TELEFONO':
                  $idE=$_POST['idEmpleado'];
                  $telE=$_POST['telE'];
                  $objEmpleados = new Empleados("","","","","","","","",$telE,"",$idE);
                  $objControlEmpleados = new ControlEmpleados($objEmpleados);
                  $msg=$objControlEmpleados->modificar('6');  
                  echo "<font size=20>$msg</font>";
                  //echo "<script>alert('Mensaje');</script>";
              break;
              case 'MODIFICAR-MOVIL':
                  $idE=$_POST['idEmpleado'];
                  $movilE=$_POST['movilE'];
                  $objEmpleados = new Empleados("","","","","","","","","",$movilE,$idE);
                  $objControlEmpleados = new ControlEmpleados($objEmpleados);
                  $msg=$objControlEmpleados->modificar('7'); 
                  echo "<font size=20>$msg</font>";
                  //echo "<script>alert('Mensaje');</script>";
              break;
              case 'MODIFICAR-FOTO':
                $idE=$_POST['idEmpleado'];
                $cmdAux="SELECT foto FROM empleado WHERE idUsuario ='".$idE."';";
                $objControlConexion= new ControlConexion();
                $objControlConexion->abrirBd('localhost', 'root','', 'bdproyectoa');
                $resultado=$objControlConexion->ejecutarSelect($cmdAux);
                $registro = $resultado->fetch_array(MYSQLI_BOTH);
                $objControlConexion->cerrarBd();
                $rAct=$registro["foto"];
                unlink($rAct);

                if(!empty($_FILES['archivo']['name'])){
                  $rutaF="empleados/".$idE."/".$_FILES['archivo']['name'];
                  if(file_exists($rutaF)){
                    echo "ERROR ARCHIVO EXISTENTE";
                    die();
                  }else{
                    $tmp=$_FILES['archivo']['tmp_name'];
                    move_uploaded_file($tmp,$rutaF);
                    $objEmpleados = new Empleados("","","","","",$rutaF,"","","","",$idE);
                    $objControlEmpleados = new ControlEmpleados($objEmpleados);
                    $msg=$objControlEmpleados->modificar('8');  
                    echo "<font size=20>$msg</font>";
                  }
                }                    
              break;
              case 'MODIFICAR-HV':
                $idE=$_POST['idEmpleado'];
                $cmdAux="SELECT hojaV FROM empleado WHERE idUsuario ='".$idE."';";
                $objControlConexion= new ControlConexion();
                $objControlConexion->abrirBd('localhost', 'root','', 'bdproyectoa');
                $resultado=$objControlConexion->ejecutarSelect($cmdAux);
                $registro = $resultado->fetch_array(MYSQLI_BOTH);
                $objControlConexion->cerrarBd();
                $rAct=$registro["hojaV"];
                unlink($rAct);
                if(!empty($_FILES['archivo']['name'])){
                  $rutaHV="empleados/".$idE."/".$_FILES['archivo']['name'];
                  if(file_exists($rutaHV)){
                    echo "ERROR ARCHIVO EXISTENTE";
                    die();
                  }else{
                    $tmp=$_FILES['archivo']['tmp_name'];
                    move_uploaded_file($tmp,$rutaHV);
                    $objEmpleados = new Empleados("","","","","","",$rutaHV,"","","",$idE);
                    $objControlEmpleados = new ControlEmpleados($objEmpleados);
                    $msg=$objControlEmpleados->modificar('9');  
                    echo "<font size=20>$msg</font>";
                  }
                } 
              break;
              case 'DESACTIVAR-EMPLEADO':
                $idE=$_POST['idEmpleado'];
                $retiroE=$_POST['retiroE'];
                $objEmpleados = new Empleados("","",$retiroE,"","","","","","","",$idE);
                $objControlEmpleados = new ControlEmpleados($objEmpleados);
                $msg=$objControlEmpleados->desactivar();  
                if($msg=="FECHA DE RETIRO MODIFICADA"){
                  echo "<font size=20>$msg</font>";
                  echo "<br>";
                  echo "<br>";
                  echo "<font color='green' size=20>EL EMPLEADO HA SIDO DESACTIVADO CORRECTAMENTE</font>";  
                }else{
                  if($msg=="EL EMPLEADO YA SE ENCUENTRA RETIRADO"){
                    echo "<font color='blue' size=20>$msg</font>";
                  }else{
                    echo "<font color='red' size=20>$msg</font>";
                    echo "<br>";
                    echo "<br>";
                    echo "<font size=20>POR FAVOR INGRESE UNA FECHA DE RETIRO VÁLIDA</font>";
                  }
                }
              break;

              }
              ?>
          

            &nbsp;
            &nbsp;
     </div>
    </div><!--fin columna información del centro-->
  </div><!--Fin row-->


  <footer class="page-footer"><!--Inicio PiedePagina-->
            <div class="container">
              <div class="row">
                <div class="col l6 s12">
              <div class="container">
              <h5 class="white-text">Ventanillas de atención.</h5>
            <p class="grey-text text-lighten-4">Campus Robledo:</p> 
            <p class="grey-text text-lighten-4">Calle 73 No. 76A - 354, Vía al Volador</p>
            <p class="grey-text text-lighten-4"> Tel: (+574) 440 51 00 - Fax: (+574) 440 51 02</p>
            &nbsp;
           
            <p class="grey-text text-lighten-4">Campus Fraternidad:</p>
            <p class="grey-text text-lighten-4">Calle 54A No. 30 - 01, Barrio Boston</p>
            <p class="grey-text text-lighten-4">Tel: (+574) 460 07 27.</p> 
             </div>
                </div>
                <div class="col l4 offset-l2 s12">
                  <h5 class="white-text">Redes</h5>
                  <ul>
                    <div>
                          <a href="#"><img src="../estilos/images/correo.png"></a>
                          <a href="#"><img src="../estilos/images/twitter.png"></a>
                          <a href="#"><img src="../estilos/images/facebook.png"></a>
                          <a href="#"><img src="../estilos/images/youtube.png"></a>

                     </div>
                  </ul>
                </div>
              </div>
            </div>
            <div class="footer-copyright">
              <div class="container">
                  
                  <h6 class="grey-text text-lighten-4 center" href="#!">© 2020  Copyright Gestión Total</h6>
              </div>
            </div>
      </footer><!--Fin Pie de Pagina-->
    </div>


    </div><!--Cierre de Container-->


<!--===============================================================================================-->
  
  <script src="../estilos/js/ValidarTipo.js"></script>
  <script src="../estilos/js/main.js"></script>
  <script src="../estilos/js/Gastronomia.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type="text/javascript" src="../estilos/js/materialize.min.js"></script>
</body>

</html>

