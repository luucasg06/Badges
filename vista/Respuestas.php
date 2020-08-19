<?php 
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
  <link rel="icon" type="image/png" href="../estilos/images/icons/IgestionV2.ico"/>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <link type="text/css" rel="stylesheet" href="../estilos/css/materialize.min.css" media="screen,projection" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../estilos/css/Estilos_2.css">
  <meta charset="utf-8">
  <title>Gestión total: Home </title>
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


        <h4>RESPUESTAS</h4>
        &nbsp;
        <?php
            $tipo=$_POST['tipo'];
            $nomA=$_POST['nomAnt'];
            $nomN=$_POST['nomNue'];
            $rpta=$_POST['respuesta'];
            
            switch($rpta){

              case 'aceptar':
                $mensaje="";
                $sv="localhost";
                $us="root";
                $ps="";
                $bd="bdproyectoa";
              
                $cmdSql="UPDATE ".$tipo." INNER JOIN usuario ON ".$tipo.".idUsuario = usuario.idUsuario SET ".$tipo.".nombre= '".$nomN."' WHERE usuario.usuario = '".$nomA."'";
                try{

                  $objControlConexion= new ControlConexion();
                  $objControlConexion->abrirBd($sv,$us,$ps,$bd);
                  $objControlConexion->ejecutarComandoSql($cmdSql);
                  $objControlConexion->cerrarBd();
                  $mensaje="SOLICITUD PROCESADA";
                }
                catch(Exception $objExp){
                  $mensaje=$objExp->getMessage();
                }
                $cmdSql="DELETE FROM solicitudes WHERE nombreanterior='".$nomA."' AND nombrenuevo='".$nomN."' ";
                try{

                  $objControlConexion= new ControlConexion();
                  $objControlConexion->abrirBd($sv,$us,$ps,$bd);
                  $objControlConexion->ejecutarComandoSql($cmdSql);
                  $objControlConexion->cerrarBd();
                }
                catch(Exception $objExp){
                  $mensaje=$objExp->getMessage();
                }
                echo "<font color=blue size=20>$msg</font>";
              break;
              case 'rechazar':
                $mensaje="";
                $sv="localhost";
                $us="root";
                $ps="";
                $bd="bdproyectoa";
              
                $cmdSql="DELETE FROM solicitudes WHERE nombreanterior='".$nomA."' AND nombrenuevo='".$nomN."' ";
                try{

                  $objControlConexion= new ControlConexion();
                  $objControlConexion->abrirBd($sv,$us,$ps,$bd);
                  $objControlConexion->ejecutarComandoSql($cmdSql);
                  $objControlConexion->cerrarBd();
                  $mensaje="SOLICITUD PROCESADA";
                }
                catch(Exception $objExp){
                  $mensaje=$objExp->getMessage();
                }
                echo "<font color=blue size=20>$msg</font>";
              break;
            }
        ?>
        <script type="text/javascript">
        function redireccionar(){
            window.location="Solicitudes.php";
         }
            setTimeout ("redireccionar()", 2000);
        </script>
      

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
                          <a href="https://outlook.office.com/mail/inbox"><img src="../estilos/images/correo.png"></a>
                          <a href="#"><img src="../estilos/images/twitter.png"></a>
                          <a href="https://www.facebook.com/johnstivennacional98"><img src="../estilos/images/facebook.png"></a>
                          <a href="https://www.youtube.com/channel/UCJofCr6PKGjqb0ljRxxuYQw?view_as=subscriber"><img src="../estilos/images/youtube.png"></a>

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

