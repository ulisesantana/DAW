//Función que escribe el html en el div con ID mirror
function render(id,html) {
  return document.getElementById(id).innerHTML = html;
}

function getJSON() { //podría ser getJSON(url, callback)
    var request = new XMLHttpRequest();
    request.open('GET','prov.json'); //aquí usaríamos la url
    request.responseType = 'json';
    request.send();

    request.onload = function(){ //este es el callback
      var prov = request.response;
      setProvForm(prov)
    }

}

function setProvForm(prov) {
  var html = '';
  for(var key in prov) {
    html += "<option value=" + key  + ">" +prov[key] + "</option>"
  }
  return render('prov',html);
}

function toggleForm(id){
  var html =`<i class="fa fa-thumbs-up" aria-hidden="true"></i>`;
  $('#form').fadeToggle();
  $(id).fadeToggle();

  if ($('#form').hasClass('hidden')) {
    render('free-cta-text','CONTRATAR');
    render('premium-cta-text','CONTRATAR');
    render('vip-cta-text','CONTRATAR');
  } else {
    render('free-cta-text',html);
    render('premium-cta-text',html);
    render('vip-cta-text',html);
  }
}

function submitEnabler() {
  if (nifValidator() && telValidator() && emailValidator() && emailChecker()) {
    $('#submit').removeClass('disabled');
  }
}

function styleValidator(id, condition) {
  if (condition) {
    $(id).removeClass('has-error');
    $(id).addClass('has-success');
  } else {
    $(id).removeClass('has-success');
    $(id).addClass('has-error');
  }
}

function nameValidator() {
  var name = $('#name').val();
  styleValidator('#name-group', name.length>2);
  return name.length>2;
}

function surnameValidator() {
  var surname = $('#surname').val();
  styleValidator('#surname-group', surname.length>2);
  return  surname.length>2;
}

function nifValidator() {
  var nif = $('#nif').val();
  var num = parseInt(nif.substring(0,nif.length-1));
  var letraUser = nif[(nif.length)-1].toUpperCase();
  var list="TRWAGMYFPDXBNJZSQVHLCKE";
  var letra = list[num%23];

  styleValidator('#nif-group',letra == letraUser);
  return letra == letraUser;
}

function telValidator() {
  var tel = $("#tel").val();
  var patt = new RegExp('(\\+{1})\\d{11}');
  styleValidator('#tel-group', patt.test(tel));
return patt.test(tel);
}

function emailValidator() {
  var email = $("#email").val();
  var patt = new RegExp('[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$');
  styleValidator('#email-group', patt.test(email));
return patt.test(email);
}

function emailChecker() {
  var email = $("#email").val();
  var emailCheck = $("#email-check").val();
  styleValidator('#email-check-group',email == emailCheck);
  return email == emailCheck;
}

function addressValidator() {
  var address = $('#address').val();
  styleValidator('#address-group', address.length>2);
  return  address.length>2;
}

function provValidator() {
  var prov = $('#prov').val();
  console.log(prov);
  styleValidator('#prov-group', prov>0);
  return  prov>0;
}



$(document).ready(function () {
  getJSON();

  $("#free").click(function() {
    if($('#form').css('display') == 'none'){
      $('#premium,#vip,#free').fadeToggle().promise().done(function(){
        toggleForm('#free');
      });
    }
    else{
      toggleForm('#free');
      $('#premium,#vip,#free').fadeToggle();
    }
  });

  $("#premium").click(function() {
    if($('#form').css('display') == 'none'){
      $('#premium,#vip,#free').fadeToggle().promise().done(function(){
        toggleForm('#premium');
      });
    }
    else{
      toggleForm('#premium');
      $('#premium,#vip,#free').fadeToggle();
    }
  });

  $("#vip").click(function() {
    if($('#form').css('display') == 'none'){
      $('#premium,#vip,#free').fadeToggle().promise().done(function(){
        toggleForm('#vip');
      });
    }
    else{
      toggleForm('#vip');
      $('#premium,#vip,#free').fadeToggle();
    }
  });

  $('#name').focusout(function() {
    nameValidator();
  });

  $('#surname').focusout(function() {
    surnameValidator();
  });

  $('#nif').focusout(function() {
    nifValidator();
  });

  $('#tel').focusout(function() {
    telValidator();
  });

  $('#email').focusout(function() {
    emailValidator();
  });

  $('#email-check').focusout(function() {
    emailChecker();
  });

  $('#address').focusout(function() {
    addressValidator();
  });

  $('#prov').focusout(function() {
    provValidator();
  });

  $('input').focusout(function(){
    submitEnabler();
  });
});
