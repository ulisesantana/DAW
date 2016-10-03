/**
***FUNCIONES COMUNES
**/

//Función para solicitar una string al usuario
function setString() {
  var msg = prompt('Escribe la cadena de texto con la que vas a trabajar:');
  return msg;
}

//Función para solicitar una string al usuario con posibilidad de default
function setStringConfirm() {
  var msg = confirm('Escribe la cadena de texto con la que vas a trabajar:');
  if (msg) {
    msg = prompt('Escribe la cadena de texto con la que vas a trabajar:');
  } else {
    msg = "The path of the righteous man is beset on all sides by the iniquities of the selfish and the tyranny of evil men. Blessed is he who, in the name of charity and good will, shepherds the weak through the valley of darkness, for he is truly his brother's keeper and the finder of lost children. And I will strike down upon thee with great vengeance and furious anger those who would attempt to poison and destroy My brothers. And you will know My name is the Lord when I lay My vengeance upon thee.";
  }
  return msg;
}

//Función para solicitar un número a un usuario
function setNum() {
  var num = parseInt(prompt('Introduce el número con el que quieres trabajar:'));
  return num;
}

//Función que escribe el html en el div con ID sandbox
function setSandbox(html) {
  return document.getElementById('sandbox').innerHTML = html;
}

//Función Fibonacci con for
function fibonacci(lim) {
  var a = 0;
  var b = 1;
  var html = '<li>0</li><li>1</li>'

  for (var i = 0; i < lim-2; i++) {
    if (a<b) {
      a+=b;
      html += '<li>'+a+'</li>'
    } else {
      b+=a;
      html += '<li>'+b+'</li>'
    }
  }
  return html;
}

//TODO: HACER FUNCIÓN PARA QUE CREE FORMULARIO EN EL MODAL
function setQuestion(quest) {

}

//Muestra la ventana modal
function modalShow(html) {
  setSandbox(html)
  $('#modal-content').modal({
    show: true
  });
}

//Serie de funciones que quedan a la espera del click en su div
$(document).ready(function() {

  /**
  ***EJERCICIO 1
  **/

  //Función para generar el alert cuando se llame
  $("#ver").click(function() {
    alert('Hola Mundo!');
  });

  //Prueba para escapar comillas
  $("#comillas").click(function() {
    const easy = 'Es fácil usar \'comillas simples\' y "comillas dobles"'.toUpperCase();
    modalShow('<h1 class="text-center lead">' + easy + '</h1>');
  });

  //Lanzamos un prompt para preguntar la edad
  $("#age").click(function() {
    var age = prompt('Dime tu edad'.toLowerCase());
    modalShow('<h1 class="text-center lead">' + 'Tienes ' + age + ' años.' + '</h1>');
  });

  //Inicializamos dos variables, una con el factorial a calcular y otro que
  //almacenará el resultado
  $("#factorial").click(function() {
    var fact = prompt('Dime el número del que quieres calcular el factorial');
    var resultado = 1;

    for (var i = fact; i > 0; i--) {
      resultado = i * resultado;
    }

    modalShow('<h1 class="text-center lead">' + 'El resultado es: ' + resultado + '</h1>');
  });

  $("#concat").click(function() {
    var text1 = setStringConfirm();
    var text2 = setStringConfirm();
    var text3 = text1 + text2;

    modalShow('<div class="col-md-6"><h2>Primera Cadena</h2>' + text1 + '</div>' + '<div class="col-md-6"><h2>Segunda Cadena</h2>' + text2 + '</div></div>' + '<div class="row"><div class="col-md-12"><h2>Suma de Cadenas</h2>' + text3 + '</div>');
  });

  $("#divideString").click(function() {
    var text1 = setStringConfirm();
    var text2 = text1.substring(0, text1.length / 2);
    var text3 = text1.substring((text1.length / 2) + 1);

    modalShow('<div class="col-md-6"><h2>Primera Cadena</h2>' + text2 + '</div>' + '<div class="col-md-6"><h2>Segunda Cadena</h2>' + text3 + '</div></div>' + '<div class="row"><div class="col-md-12"><h2>Suma de Cadenas</h2>' + text1 + '</div>');
  });

  $("#charPosition").click(function() {
    var text = setStringConfirm();
    var position = "";
    var char = prompt('¿Qué carácter quieres buscar?').split(0, 1);

    for (var i = 0; i < text.length; i++) {
      if (char == text[i]) {
        position += '<li>' + (i + 1).toString() + '</li>';
      }
    }

    if (position == "") {
      position = "No existen coincidencias.";
    }

    modalShow('<div class="col-md-3">' + '<h3 class="text-center lead">Posiciones del carácter: <strong>' + char + '</strong></h3>' + '<ul>' + position + '</ul></div><div class="col-md-9"><h3 class="text-center">Texto a Analizar</h3><p>' + text + '</p></div>');
  });

  //Comprobador de palíndromos
  $("#palindrome").click(function() {
    //Expresión regular para que el replace quite cualquier caracter que no sea una letra o un número
    var regex = /[\W_]/g;
    var text = setString();
    //Pasamos a lowercase y removemos todo lo que no sea una letra o un número
    var low = text.toLowerCase().replace(regex, '');
    //Ahora le damos la vuelta a la string
    var rev = low.split('').reverse().join('');

    //Comprobamos que ambas cadenas son iguales
    if (rev === low) {
      var html ='<div class="container"><p>'+text+' es un palíndromo</p></div>'
    }
    else {
      var html ='<div class="container"><p>'+text+' no es un palíndromo</p></div>';
    }

    modalShow(html);
  });

  //Asesino de vocales
  $("#vocalKiller").click(function() {
    //Expresión regular para que el replace quite las vocales
    var regex = /[aeiou]/gi;
    var text = setStringConfirm();

    //Eliminamos las vocales con el replace
    var text = text.replace(regex, '');

    var html ='<div class="container"><h3 class="text-primary">Tu texto sin vocales</h3><p>'+text+'</p></div>';

    modalShow(html);
  });

  //Método reverse para cadenas con for
  $("#reverse").click(function () {
    var text = setStringConfirm();
    var rev='';

    for (var i = text.length-1; i >= 0; i--) {
      rev += text[i];
    }

    var html ='<div class="pad"><h3 class="text-primary">Tu texto al revés</h3><p> <strong>Al derecho: </strong>'+text+'</p><p> <strong>Al réves: </strong>'+ rev +'</p></div>';
    modalShow(html);
  });

  $('#fibonacci').click(function () {
    var num= parseInt(setString());
    var a = 0;
    var b = 1;
    var text = '0, 1';

    if (num<2) {
      text='Trata de usar un número de repeticiones mayor'
    }
    else {
      for (var i = 0; i < num-2; i++) {
        if (a<b) {
          a+=b;
          text += ', '+a;
        } else {
          b+=a;
          text += ', '+b;
        }
      }
    }
    text+='.';
    var html ='<div class="pad"><h3 class="text-primary">Secuencia de Fibonacci</h3><p>'+text+'</p></div>';
    modalShow(html);
  })


  $("#split").click(function() {
    var words = setStringConfirm().split(" ");
    var list = '';
    for (var i = 0; i < words.length; i++) {
      list += '<li>' + words[i] + '</li>';
    }
    modalShow('<ul>' + list + '</ul>');
  });


  $("#stringLength").click(function() {
    modalShow('<p class="text-center">' + setStringConfirm().length + '</p>');
  });

  $("#substring").click(function() {
    var text = setStringConfirm();
    var start = parseInt(prompt('Dime en que posición quieres empezar el corte:'));
    var end = parseInt(prompt('Dime en que posición quieres terminar el corte:'));

    if (end&&start) {
      var cut = text.substring(start,end);
    }
    else if (start) {
      var cut = text.substring(start);
    }
    else{
      var cut = 'Lo que me has pedido no tiene maldita lógica.'
    }

    modalShow('<div class="col-md-6"><h2>Texto original</h2>' + text + '</div>' + '<div class="col-md-6"><h2>Texto recortado</h2>' + cut + '</div>');
  });

  //Sumamos los pares y los impares de un número
  $("#suma-loca").click(function() {
    var num = setNum();
    var par = 0;
    var impar = 0;
    var sumpar = '';
    var sumimpar = '';

    for (var i = 0; i <= num; i++) {
      if (i%2) {
        par+=i;
        sumpar += ' + '+i;
      } else {
        impar+=i;
        sumimpar += ' + '+i;
      }
    }

    sumpar = sumpar.substring(3);
    sumimpar = sumimpar.substring(3);

    var html = `
    <div class="row center-block">
    <h2 class="text-center">Suma de pares e impares para `+num+`</h2>
      <div class="col-md-6">
        <p>
          <strong>Pares: </strong>`+sumpar+` = `+par+`</div>
        </p>
        <div class="col-md-6">
          <p>
            <strong>Impares: </strong>`+sumimpar+` = `+impar+`</div>
          </p>
    </div>`;
    modalShow(html);
  });

  //for mostrando los niveles de H
  $("#h-family").click(function() {
    var text='';
    for (var i = 0; i < 6; i++) {
      text += '<h'+(i+1)+' class="text-center"> Esto es un H'+(i+1)+'</h'+(i+1)+'>'
    }

    var html = `
    <div class="row center-block">`
      +text+
    `</div>`;
    modalShow(html);
  });

  /**
  ***EJERCICIO 2
  **/

  //Calculadora de letra DNI
  $("#dni-checker").click(function() {
    var dni = setString().toUpperCase();
    var num = parseInt(dni.substring(0,dni.length-1));
    var letraUser = dni[(dni.length)-1].toUpperCase();
    var list="TRWAGMYFPDXBNJZSQVHLCKE";
    var letra = list[num%23];

    if (letra == letraUser) {
      var html = `
      <div class="row center-block">
      <p class="text-center text-success">
        El DNI `+dni+` es válido.
      </p>
      </div>`;
    } else {
      var html = `
      <div class="row center-block">
      <p class="text-center text-danger">
      El DNI `+dni+` no es válido.
      </p>
      </div>`;
    }
    modalShow(html);
  });

});
