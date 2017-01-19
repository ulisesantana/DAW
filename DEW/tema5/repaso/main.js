function submitEnabler() {
  if (nifValidator() &&
    nameValidator() &&
    surnameValidator() &&
    emailValidator() &&
    passChecker() &&
    yearValidator()) {
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
  styleValidator('name-group', name.length > 2);
  return name.length > 2;
}

function surnameValidator() {
  var surname = document.getElementById('surname').value;
  styleValidator('surname-group', surname.length > 2);
  return surname.length > 2;
}

function nifValidator() {
  var nif = document.getElementById('nif').value;
  var patt = new RegExp('([\\d]{8})([- | \\s]?)([A-z])')

  if (patt.test(nif)) {
    var validator = true;
  } else {
    var validator = false;
  }

  styleValidator('nif-group', validator);
  return validator;
}

function emailValidator() {
  var email = document.getElementById('email').value;
  var patt = new RegExp('[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$');
  styleValidator('email-group', patt.test(email));
  return patt.test(email);
}

function passwordValidator() {
  var password = document.getElementById('password').value;
  var patt = new RegExp('^(?=.*[A-z])(?=.*\\d)[A-z\\d]{8,}$');
  styleValidator('password-group', patt.test(password));
  return patt.test(password);
}

function passChecker() {
  var password = document.getElementById('password').value;
  var passwordCheck = document.getElementById('password-check').value;
  styleValidator('check-password-group', ((password == passwordCheck)));
  return password == passwordCheck;
}

function yearValidator() {
  var fullYear = document.getElementById('year').value;
  var date = new Date();
  var limit = date.getFullYear();

  var patt = new RegExp('(\\d{4})-(\\d{4})');

  if (patt.test(fullYear)) {
    fullYear = fullYear.split('-');
    var year = fullYear[0];
    var nextYear = fullYear[1];

    if (year <= limit && year == (nextYear - 1)) {
      var validator = true;
    } else {
      var validator = false;
    }

  } else {
    var validator = false;
  }

  styleValidator('year-group', validator);
  return validator;
}

window.onload = function() {
  document.getElementById('name').addEventListener('focusout', nameValidator);
  document.getElementById('surname').addEventListener('focusout', surnameValidator);
  document.getElementById('nif').addEventListener('focusout', nifValidator);
  document.getElementById('email').addEventListener('focusout', emailValidator);
  document.getElementById('password').addEventListener('focusout', passwordValidator);
  document.getElementById('password-check').addEventListener('focusout', passChecker);
  document.getElementById('year').addEventListener('focusout', yearValidator);

  var inputs = document.getElementsByTagName('input');
  Array.prototype.forEach.call(inputs, function(el, index, array){
    el.addEventListener('focusout', submitEnabler);
  });

};
