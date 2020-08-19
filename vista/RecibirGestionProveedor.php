<?php 
include('../modelo/Proveedores.php');
include('../modelo/ProdProv.php');
include('../control/ControlProdProv.php');
include('../control/ControlProveedores.php');
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
  <title>Gestión Total: Respuesta Gestión Proveedor</title>
<link rel="icon" type="image/png" href="../estilos/images/icons/IgestionV2.ico"/>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <link type="text/css" rel="stylesheet" href="../estilos/css/materialize.min.css" media="screen,projection" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../estilos/css/Estilos_2.css">
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
          
            case 'AGREGAR-PRODUCTO':
              $idProv=$_POST['idProveedor'];
              $idProd=$_POST['idProducto'];
              $objPP= new ProdProv($idProv,$idProd);
              $objControlPP = new ControlProdProv($objPP);
              $msg=$objControlPP->guardar();
              if($msg=='PRODUCTO AGREGADO EXITOSAMENTE'){
                
                $cmdAux="SELECT * FROM proveedor WHERE idProveedor='".$idProv."'";
                $objControlConexion= new ControlConexion();
                $objControlConexion->abrirBd('localhost', 'root','', 'bdproyectoa');
                $resultado=$objControlConexion->ejecutarSelect($cmdAux);
                $registro1 = $resultado->fetch_array(MYSQLI_BOTH);

                $cmdAux="SELECT * FROM producto WHERE idProducto='".$idProd."'";
                $objControlConexion= new ControlConexion();
                $objControlConexion->abrirBd('localhost', 'root','', 'bdproyectoa');
                $resultado=$objControlConexion->ejecutarSelect($cmdAux);
                $registro2 = $resultado->fetch_array(MYSQLI_BOTH);
                echo "<font size=20>$msg</font>";
            ?>
                <center>
                  <table class="tc">
                    <tr>
                      <th>PROVEEDOR</th>
                      <th>PRODUCTO</th>
                      <th>IMAGEN</th>
                    </tr>
                    <tr>
                      <td><?php echo $registro1['nombre'] ?></td>
                      <td><?php echo $registro2['nombre'] ?></td>
                      <td><?php echo "<img height=\"70\" width=\"70\" src=\"".$registro2['foto']."\"" ?></td>    
                    </tr>
                  </table>
          <?php 
              }
            break;

            case 'REGISTRAR':
            $nom=$_POST['nombre'];
            $tpro=$_POST['tpro'];
            $fre=$_POST['fechaR'];
            $fina=$_POST['fechaI'];
            $mail=$_POST['email'];
            $tele=$_POST['Tele'];
            $IdU=$_POST['iper'];
            $lat=$_POST['lat'];
            $long=$_POST['long'];

            if($_FILES["archivo"]["error"]>0){
                echo "ERROR";
              } 
                else{
                  $permitidos=array("image/png","image/jpg");
                  $limite_kb=500;
                  if(in_array($_FILES["archivo"]["type"], $permitidos) && $_FILES["archivo"]["size"]<=$limite_kb*1024){

                  $rutaone='proveedores/'.$IdU.'/';
                  $archivo=$rutaone.$_FILES["archivo"]["name"];

                  if(!file_exists($rutaone)) {
                    mkdir($rutaone, 0777, true);
                  }

                  if(!file_exists($archivo)){

                    $resultado=@move_uploaded_file($_FILES["archivo"]["tmp_name"], $archivo);
                    $objProveedores= new Proveedores($nom,$tpro,$fre,$fina,$archivo,$mail,$tele,$IdU,$lat,$long);
                    $objControlProveedores = new ControlProveedores($objProveedores);
                    $msg=$objControlProveedores->guardar(); 
                    $Sql="SELECT p.nombre, u.usuario, u.contrasena from proveedor p inner JOIN usuario u on p.idUsuario=u.idUsuario where u.idUsuario='".$IdU."';";
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
                      break;
                      mysqli_close($conexion);                    

                    mail($mail,"USUARIO Y CONTRSEÑA DE GESTION TOTAL", "");

                    if($resultado){
                        echo "<font size=20> HA OCURRIDO UN ERROR </font>";
                    } else{
                        echo "<font size=20> HA OCURRIDO UN ERROR </font>";
                    }

                  }else{
                      echo "<font size=20> HA OCURRIDO UN ERROR </font>";
                  }
                }else{
                  echo "<font size=20> HA OCURRIDO UN ERROR </font>";
                }
              }
              break;
              case 'CONSULTAR':
              $nom=$_POST['nombre'];
              $objProveedores= new Proveedores($nom,"","","","","","","","","");
              $objControlProveedores = new ControlProveedores($objProveedores);

              $Sql="SELECT * FROM proveedor WHERE nombre LIKE '".$nom."%'";
              
              $conexion=mysqli_connect('localhost', 'root','', 'bdproyectoa');
              $resultadoCC=mysqli_query($conexion,$Sql);
              ?>
              <center>
              <table class="tc2">
                  <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>TIPO</th>
                    <th>FECHA DE REGISTRO</th>
                    <th>FECHA DE RETIRO</th>
                    <th>E-MAIL</th>
                    <th>TELÉFONO</th>
                    <th>FOTO</th>
                    <th>UBICACIÓN</th>
                  </tr>
              <?php 
               while($resultadosC=mysqli_fetch_array($resultadoCC)){
                if($resultadosC['fechaInactivo'] == "0000-00-00"){
                  $retiro = 'Activo';
                }else{
                  $retiro = $resultadosC['fechaInactivo'];
                }
              ?>
                  <tr>
                    <td><?php echo $resultadosC['idProveedor'] ?></td>
                    <td><?php echo $resultadosC['nombre'] ?></td>
                    <td><?php echo $resultadosC['tipo'] ?></td>
                    <td><?php echo $resultadosC['fechaRegistro'] ?></td>
                    <td><?php echo $retiro ?></td>
                    <td><?php echo $resultadosC['email'] ?></td>
                    <td><?php echo $resultadosC['telefono'] ?></td>
                    <td><?php echo "<img height=\"70\" width=\"70\" src=\"".$resultadosC['foto']."\"" ?></td>
                    <td> <form action="./Ubicaciones.php" method="get" target="_blank">
                    <input type="hidden" name="lati" id="lati" value="<?php echo $resultadosC['Latitud'] ?>">
                    <input type="hidden" name="long" id="long" value="<?php echo $resultadosC['longitud'] ?>">
                    <input class="boton" type="submit" value= "Ubicar" >
                    </form> </td>
                  </tr>

              <?php
              } 
              ?>
              </table></center>
              <?php 
              break;

              case 'CONSULTARTODOS':
              $nom=$_POST['nombre'];
              $objProveedores= new Proveedores($nom,"","","","","","","","","");
              $objControlProveedores = new ControlProveedores($objProveedores);

              $Sql="SELECT * FROM proveedor ;";
              
              $conexion=mysqli_connect('localhost', 'root','', 'bdproyectoa');
              $resultadoCC=mysqli_query($conexion,$Sql);
              ?>
              <center>
              <table class="tc2">
                  <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>TIPO</th>
                    <th>FECHA DE REGISTRO</th>
                    <th>FECHA DE RETIRO</th>
                    <th>E-MAIL</th>
                    <th>TELÉFONO</th>
                    <th>FOTO</th>
                    <th>UBICACIÓN</th>
                  </tr>
              <?php 
               while($resultadosC=mysqli_fetch_array($resultadoCC)){
                if($resultadosC['fechaInactivo'] == "0000-00-00"){
                  $retiro = 'Activo';
                }else{
                  $retiro = $resultadosC['fechaInactivo'];
                }
              ?>
                  <tr>
                    <td><?php echo $resultadosC['idProveedor'] ?></td>
                    <td><?php echo $resultadosC['nombre'] ?></td>
                    <td><?php echo $resultadosC['tipo'] ?></td>
                    <td><?php echo $resultadosC['fechaRegistro'] ?></td>
                    <td><?php echo $retiro ?></td>
                    <td><?php echo $resultadosC['email'] ?></td>
                    <td><?php echo $resultadosC['telefono'] ?></td>
                    <td><?php echo "<img height=\"70\" width=\"70\" src=\"".$resultadosC['foto']."\"" ?></td>

                    <td> <form action="./Ubicaciones.php" method="get" target="_blank">
                    <input type="hidden" name="lati" id="lati" value="<?php echo $resultadosC['Latitud'] ?>">
                    <input type="hidden" name="long" id="long" value="<?php echo $resultadosC['longitud'] ?>">
                    <input class="boton" type="submit" value= "Ubicar" >
                    </form> </td>
                  </tr>
              <?php
              } 
              ?>
              </table></center>
              <?php 
              break;
              case 'MODIFICAR-NOMBRE':
                  $idP=$_POST['idProveedor'];
                  $nomP=$_POST['nombreP'];
                  $objProveedores= new Proveedores($nomP,"","","","","","",$idP);
                  $objControlProveedores = new ControlProveedores($objProveedores);
                  $msg=$objControlProveedores->modificar('1'); 
                  echo "<font size=20>$msg</font>";
                  //echo "<script>alert('Mensaje');</script>";
              break;
              case 'MODIFICAR-TIPO':
                  $idP=$_POST['idProveedor'];
                  $tpro=$_POST['tpro'];
                  $objProveedores= new Proveedores("",$tpro,"","","","","",$idP);
                  $objControlProveedores = new ControlProveedores($objProveedores);
                  $msg=$objControlProveedores->modificar('2'); 
                  echo "<font size=20>$msg</font>";
                  //echo "<script>alert('Mensaje');</script>";
              break;
              case 'MODIFICAR-INGRESO':
                  $idP=$_POST['idProveedor'];
                  $fechaIn=$_POST['fechaIn'];
                  $objProveedores= new Proveedores("","",$fechaIn,"","","","",$idP);
                  $objControlProveedores = new ControlProveedores($objProveedores);
                  $msg=$objControlProveedores->modificar('3');  
                  echo "<font size=20>$msg</font>";
                  //echo "<script>alert('Mensaje');</script>";
              break;
              case 'MODIFICAR-FOTO':
                $idP=$_POST['idProveedor'];
                $cmdAux="SELECT foto FROM proveedor WHERE idUsuario ='".$idP."';";
                $objControlConexion= new ControlConexion();
                $objControlConexion->abrirBd('localhost', 'root','', 'bdproyectoa');
                $resultado=$objControlConexion->ejecutarSelect($cmdAux);
                $registro = $resultado->fetch_array(MYSQLI_BOTH);
                $objControlConexion->cerrarBd();
                $rAct=$registro["foto"];
                unlink($rAct);

                if(!empty($_FILES['archivo']['name'])){
                  $rutaF="proveedores/".$idP."/".$_FILES['archivo']['name'];
                  if(file_exists($rutaF)){
                    echo "ERROR ARCHIVO EXISTENTE";
                    die();
                  }else{
                    $tmp=$_FILES['archivo']['tmp_name'];
                    move_uploaded_file($tmp,$rutaF);
                    $objProveedores= new Proveedores("","","","",$rutaF,"","",$idP);
                    $objControlProveedores = new ControlProveedores($objProveedores);
                    $msg=$objControlProveedores->modificar('4');   
                    echo "<font size=20>$msg</font>";
                  }
                }                    
              break;
              case 'MODIFICAR-EMAIL':
                  $idP=$_POST['idProveedor'];
                  $emailC=$_POST['emailC'];
                  $objProveedores= new Proveedores("","","","","",$emailC,"",$idP);
                  $objControlProveedores = new ControlProveedores($objProveedores);
                  $msg=$objControlProveedores->modificar('5');  
                  echo "<font size=20>$msg</font>";
                  //echo "<script>alert('Mensaje');</script>";
              break;
              case 'MODIFICAR-TELEFONO':
                  $idP=$_POST['idProveedor'];
                  $telP=$_POST['telP'];
                  $objProveedores= new Proveedores("","","","","","",$telP,$idP);
                  $objControlProveedores = new ControlProveedores($objProveedores);
                  $msg=$objControlProveedores->modificar('6');  
                  echo "<font size=20>$msg</font>";
                  //echo "<script>alert('Mensaje');</script>";
              break;

              case 'DESACTIVAR-PROVEEDOR':
                $idP=$_POST['idProveedor'];
                $retiroP=$_POST['retiroP'];
                $objProveedores= new Proveedores("","","",$retiroP,"","","",$idP);
                $objControlProveedores = new ControlProveedores($objProveedores);
                $msg=$objControlProveedores->desactivar();  
                if($msg=="FECHA DE RETIRO MODIFICADA"){
                  echo "<font size=20>$msg</font>";
                  echo "<br>";
                  echo "<br>";
                  echo "<font color='green' size=20>EL PROVEEDOR HA SIDO DESACTIVADO CORRECTAMENTE</font>";  
                }else{
                  if($msg=="EL PROVEEDOR YA SE ENCUENTRA RETIRADO"){
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

