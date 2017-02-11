$(document).ready(function(){
  $('input').on('blur', enable_disable_btn);
  $('#nif').on('blur', validarNIF);
  $('#submit').on('click', function(){
    var form = $('#form');
    form.disabled;
  });
});

function enable_disable_btn(){

  var nombre = document.getElementById("nombre").value;
  var apellidos = document.getElementById("apellidos").value;
  var email = document.getElementById("email").value;

  if(nombre.length  >0 && apellidos.length > 0 && validarNIF() && email.length > 0){
    $('#submit').removeClass('disabled');
  }
}

function validarNIF(){
  var nif = document.getElementById("nif").value;
  var num = parseInt(nif.substring(0,nif.length-1));
  var letraUser = nif[(nif.length)-1].toUpperCase();
  var lista = ['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B','N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E', 'T'];
  var letra = lista[num%23];

  if(nif.length == 9) {
    var validator = letra == letraUser;
  } else {
    var validator = false;
  }

  if (validator) {
    $('#nif-group').removeClass('has-error');
    $('#nif-group').addClass('has-success');
  } else {
    $('#nif-group').removeClass('has-success');
    $('#nif-group').addClass('has-error');
  }
  return validator;
}
