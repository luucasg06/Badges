<!DOCTYPE html>
<html>
<head>
  <link rel="icon" type="image/png" href="../estilos/images/icons/IgestionV2.ico"/>
 <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/>
  <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
   integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
   crossorigin=""></script>
<title>Gestión Total: Ubicación de clientes</title>
</head>
<body>
  <center><h1 style="color: blue ">UBICACION DE LOS EMPLEADOS</h1> </center>
  <center>
  <?php
  $lati="";
  $long="";
              $Sql="SELECT * FROM empleado ";
              
              $conexion=mysqli_connect('localhost', 'root','', 'bdproyectoa');
              $resultadoCC=mysqli_query($conexion,$Sql);
              
               while($resultadosC=mysqli_fetch_array($resultadoCC)){
             
              
                  
                    $lati= $resultadosC['Latitud'];
                    $long= $resultadosC['longitud'];
               }
              ?>


<div id="mapid" style="width:1200px; height:800px;"></div>
                           <script type="text/javascript"> 
                              var mymap = L.map('mapid').setView([6.2452905,-75.5842882], 13);
                              L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1Ijoiam9obnJlc3RyZXBvMjQ2MTU1IiwiYSI6ImNrOTRydjN2MDBnN3EzZ21zZXNmc29vZWkifQ.gopHKIExiOMX2p9MIgW7vg', 
                              {
                              attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                              maxZoom: 18,
                              id: 'mapbox/streets-v11',
                              tileSize: 512,
                              zoomOffset: -1,
                              accessToken: 'your.mapbox.access.token'
                          }).addTo(mymap);
<?php
  $lati="";
  $long="";
  $nombre="";
              $Sql="SELECT * FROM empleado ";
              
              $conexion=mysqli_connect('localhost', 'root','', 'bdproyectoa');
              $resultadoCC=mysqli_query($conexion,$Sql);
              
               while($resultadosC=mysqli_fetch_array($resultadoCC)){
             
              
                  $nombre=$resultadosC['nombre'];
                    $lati= $resultadosC['Latitud'];
                    $long= $resultadosC['longitud'];
               
?>
             
                            var x=<?php echo $lati ?>;
                            var y=<?php echo $long ?>;
                            L.marker([x,y]).addTo(mymap).addTo(mymap).bindPopup("<?php echo $nombre ?>").openPopup();
<?php
                }
?>                         
                                                                             
                             

                           </script>
                         </center>
                      

</body>
</html>
