document.addEventListener('DOMContentLoaded', function() {

  var elems = document.querySelectorAll('.sidenav');
  var instances = M.Sidenav.init(elems);

  M.AutoInit();

  var elems = document.querySelectorAll('.slider');
  var instances = M.Slider.init(elems);

  var elems = document.querySelectorAll('.tooltipped');
  var instances = M.Tooltip.init(elems);




});
