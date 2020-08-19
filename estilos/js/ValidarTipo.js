function ValidarTipo(){
 var tipo=document.getElementById("tipo").value;
 var name=document.getElementById("name").value;
 var fres=document.getElementById("fres").value;
 var fina=document.getElementById("fina").value;
 var img=document.getElementById("img").value;
 var mail=document.getElementById("mail").value;
 var tel=document.getElementById("tel").value;
 var cre=document.getElementById("cre").value;
 var iper=document.getElementById("iper").value;
    if(tipo!="NATURAL" && tipo!="JURIDICO" && tipo!="natural" && tipo!="juridico"){
       alert("El campo tipo cliente es incorrecto. Debe ser: NATURAL o JURIDICO");
        return false;
     } 
      else if (name === "" || fres === "" || img === "" || mail === "" || tel === "" || cre === "" || iper === ""){
         alert("Todos los campos son obligatorios");
        return false
      }
}

function ValidarUser(){
   var user=document.getElementById("user").value;
   var con=document.getElementById("con").value;
   var tper=document.getElementById("tper").value;
      if(tper<1 || tper>5 ){
        alert("El campo tipo usuario es incorrecto, debe recibir valores entre 1 y 5:\n1.Administrador\n2.Empleado\n3.Cliente\n4.Proveedor");
        return false;
      } 
      else if (user === "" || con === "" || tper === "" ){
        alert("Todos los campos son obligatorios");
        return false
       }
 }

function ValidarContra(){
   var user=document.getElementById("user").value;
   var con=document.getElementById("con").value;
   var conn=document.getElementById("conn").value;
   var conf=document.getElementById("conf").value;
       if(conn!=conf ){
           alert("La contraseña nueva no conincide.");
            return false;
        } 
          else if (user === "" || con === "" || conn === "" || conf === ""){
            alert("Todos los campos son obligatorios");
              return false
          }
}
function ValidarEliminarU(){
  var user=document.getElementById("user").value;
  var con=document.getElementById("con").value;
     if (user === "" || con === "" ){
        alert("Todos los campos son obligatorios");
         return false
      }   
}


