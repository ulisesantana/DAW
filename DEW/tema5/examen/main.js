function submitEnabler() {
  if (nameValidator() &&
      surnameValidator() &&
      emailValidator() &&
      passwordValidator()){
      document.getElementById('submit').classList.remove('disabled');
  }
}


function styleValidator(id, condition) {
  if (condition) {
    document.getElementById(id).classList.remove('has-error');
    document.getElementById(id).classList.add('has-success');
  } else {
    // var focus = id.split('-');
    // console.log(focus[0]);
    document.getElementById(id).classList.remove('has-success');
    document.getElementById(id).classList.add('has-error');
    //$(focus[0]).focus();
  }
}

function nameValidator() {
  var name = document.getElementById('name').value;

  if(name == null || name.length == 0){
    document.getElementById('name-error').innerHTML = 'El campo nombre no puede estar vacío. Gracias';
  }
  else{
    document.getElementById('name-error').innerHTML = '';
  }

  var patt = new RegExp('[A-z]{1,15}')
  styleValidator('name-group', patt.test(name));
  return patt.test(name);
}

function surnameValidator() {
  var surname = document.getElementById('surname').value;
  var patt = new RegExp('[A-z]{1,10}');

  if(surname == null || surname.length == 0){
    document.getElementById('surname-error').innerHTML = 'El campo primer apellido no puede estar vacío. Gracias';
  }
  else{
    document.getElementById('surname-error').innerHTML = '';
  }

  styleValidator('surname-group', patt.test(surname));
  return patt.test(surname);
}

function emailValidator() {
  var email = document.getElementById('email').value;
  var patt = new RegExp('([a-zA-Z0-9]+[\\.|_|\\-]*)*@gmail\\.(com|es)?');

  if(!patt.test(email)){
    document.getElementById('email-error').innerHTML = 'El correo debe ser gmail.';
  }
  else{
    document.getElementById('email-error').innerHTML = '';
  }

  styleValidator('email-group', patt.test(email));
  return patt.test(email);
}

function passwordValidator() {
  var password = document.getElementById('password').value;
  var patt = new RegExp('^a.+\\d.{4,}a$');
  styleValidator('password-group', patt.test(password));
  return patt.test(password);
}

window.onload = function() {
  document.getElementById('name').addEventListener('focusout', nameValidator);
  document.getElementById('surname').addEventListener('focusout', surnameValidator);
  document.getElementById('email').addEventListener('focusout', emailValidator);
  document.getElementById('password').addEventListener('focusout', passwordValidator);

  var inputs = document.getElementsByTagName('input');
  Array.prototype.forEach.call(inputs, function(el, index, array){
    el.addEventListener('focusout', submitEnabler);
  });

  document.getElementById('submit').addEventListener('click', function(){
    var man = document.getElementById('hombre');
    var woman = document.getElementById('mujer');

    if(!man.checked && !woman.checked) {
      alert('Se van a enviar tus datos, aunque tu sexo no está marcado.');
    }
    else{
      alert('Se van a enviar tus datos y todo está validado');
    }
  });
};
