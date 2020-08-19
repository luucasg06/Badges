$(document).ready(function(){

//Metodo que hace que el menu se oculte o se despliegue si estoy en una tablet o celular
  $('.btn-menu').click(function(e){
     $('.contenedor-menu .menu').slideToggle();
  });

//metodo que me permite siempre visualizar el menu siempre que sea mayor a un dispositivo movil(450)
  $(window).resize(function(){

 if($(this).width() > 450){
 $('.contenedor-menu .menu').css({'display' : 'block'});
 }

 if($(this).width() < 450){
 $('.contenedor-menu .menu').css({'display' : 'none'});

 }

   });

});
