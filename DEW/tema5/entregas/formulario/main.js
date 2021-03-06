function submitEnabler() {
  if (nifValidator() &&
    nameValidator() &&
    surnameValidator() &&
    emailValidator() &&
    passChecker()) {
    $('#submit').removeClass('disabled');
  }
}

function styleValidator(id, condition) {
  if (condition) {
    $(id).removeClass('has-error');
    $(id).addClass('has-success');
  } else {
    // var focus = id.split('-');
    // console.log(focus[0]);
    $(id).removeClass('has-success');
    $(id).addClass('has-error');
    //$(focus[0]).focus();
  }
}

function nameValidator() {
  var name = $('#name').val();
  styleValidator('#name-group', name.length > 2);
  return name.length > 2;
}

function surnameValidator() {
  var surname = $('#surname').val();
  styleValidator('#surname-group', surname.length > 2);
  return surname.length > 2;
}

function nifValidator() {
  var nif = $('#nif').val();
  var patt = new RegExp('([\\d]{8})([- | \\s]?)([A-z])')

  if (patt.test(nif)) {
    var validator = true;
  } else {
    var validator = false;
  }

  styleValidator('#nif-group', validator);
  return validator;
}

function emailValidator() {
  var email = $("#email").val();
  var patt = new RegExp('[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$');
  styleValidator('#email-group', patt.test(email));
  return patt.test(email);
}

function passwordValidator() {
  var password = $("#password").val();
  var patt = new RegExp('^(?=.*[A-z])(?=.*\\d)[A-z\\d]{8,}$');
  styleValidator('#password-group', patt.test(password));
  return patt.test(password);
}

function passChecker() {
  var password = $("#password").val();
  var passwordCheck = $("#password-check").val();
  styleValidator('#check-password-group', ((password == passwordCheck)));
  return password == passwordCheck;
}

function yearValidator() {
  var fullYear = $('#year').val();
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

  styleValidator('#year-group', validator);
  return validator;
}

$(document).ready(function() {
  $('#name').focusout(function() {
    nameValidator();
  });

  $('#surname').focusout(function() {
    surnameValidator();
  });

  $('#nif').focusout(function() {
    nifValidator();
  });

  $('#email').focusout(function() {
    emailValidator();
  });

  $('#password').focusout(function() {
    passwordValidator();
  });

  $('#check-password').focusout(function() {
    passChecker();
  });

  $('#year').focusout(function() {
    yearValidator();
  });

  $('input').focusout(function() {
    submitEnabler();
  });
});
