<?php 
session_start();
if(isset($_SESSION["Usu"])){
 header("Location: Home.php");
} else if(isset($_SESSION["Cli"])){
 header("Location: HomeClientes.php");
}else if(isset($_SESSION["UsuProv"])){
 header("Location: HomeProveedor.php");
}else if(isset($_SESSION["UsuEmp"])){
 header("Location: HomeEmpleado.php");
}
 ?>
<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
include("../modelo/Administrador.php");
include("../control/ControlAdmin.php");
include("../control/ControlConexion.php");

try{
    $usu=$_POST["txtUsuario"];
    $con=$_POST["txtContrasena"];
    $bot=$_POST["boton"];
 
    if($bot=="Ingresar"){
    $objAdmin=new Administrador($usu,$con);
    $objControlAdmin =new ControlAdmin($objAdmin);
        if($objControlAdmin->validarIngreso()){
			$_SESSION['Usu']=  $usu;
            $_SESSION['Con']=  $con;
            header('Location: Home.php');
        }
        else{
            echo "<script>alert('Usuario y/o contraseña incorrectos');</script>";
        }
    }
}
catch (Exception $objExp) {
    echo 'Se presentó una excepción: ',  $objExp->getMessage(), "\n";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>Gestion Total</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="../estilos/images/icons/IgestionV2.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../estilos/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../estilos/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../estilos/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../estilos/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../estilos/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../estilos/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../estilos/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../estilos/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="../estilos/css/util.css">
	<link rel="stylesheet" type="text/css" href="../estilos/css/main.css">
        <link rel="stylesheet" type="text/css" href="../estilos/css/estilos.css">
        <link rel="stylesheet" type="text/css" href="../estilos/css/estilos_1.css">
<!--===============================================================================================-->
</head>
<body>
	<header>
            	<nav class="navegacion1">
                   
                    <ul  class="menu1">
                                
					<li><a href="LoginAdmin.php">Administrador</a></li>
					<li><a href="LoginClientes.php">Clientes</a></li>
					<li><a href="LoginEmpleados.php">Empleados</a></li>
					<li><a href="LoginProveedores.php">Proveedores</a></li>
				
			</ul>
                      
		</nav>
             <nav class="navegacion">
			<ul class="menu">
                                <li><img src="../estilos/images/gestion.png" alt="Logo" height="55" width="220"></li>
				
                                <li><a href="acerca.html">Acerca  </a></li>
				<li><a>Nosotros</a>
					<ul class="submenu">
						
						<li><a href="Mision.html">MISIÓN</a></li>
						<li><a href="Vision.html">VISIÓN</a></li>
					</ul>
					<li><a href='contactenos.html' >Contáctenos</a></li>
				</li>
			</ul>
		</nav>
		
	</header>
    
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-b-160 p-t-50">
                        
                            <form class="login100-form validate-form" action="LoginAdmin.php" method="post">
					<span class="login100-form-title p-b-43">
						INICIAR SESIÓN ADMINISTRADOR 
					</span>
					
					<div class="wrap-input100 rs1 validate-input" data-validate = "El usuario es obligatorio">
						<input class="input100" type="text" name="txtUsuario" >
						<span class="label-input100">Usuario</span>
					</div>
					
					
					<div class="wrap-input100 rs2 validate-input" data-validate="La contraseña es obligatoria">
						<input class="input100" type="password" name="txtContrasena">
						<span class="label-input100">Contraseña</span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" name="boton" value="Ingresar">
							Entrar
						</button>
					</div>
                                                &nbsp;
                                                <h4 class="alert-danger" > </h4>
					
				</form>
			</div>
		</div>
	</div>
	
	

	
	
<!--===============================================================================================-->
	<script src="../estilos/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="../estilos/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="../estilos/vendor/bootstrap/js/popper.js"></script>
	<script src="../estilos/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="../estilos/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="../estilos/vendor/daterangepicker/moment.min.js"></script>
	<script src="../estilos/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="../estilos/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="../estilos/js/main.js"></script>

</body>
</html>
