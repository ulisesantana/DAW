//Función para solicitar una string al usuario
function setString() {
    var msg = confirm('Escribe la cadena de texto con la que vas a trabajar:');
    if (msg) {
        msg = prompt('Escribe la cadena de texto con la que vas a trabajar:');
    } else {
        msg = "The path of the righteous man is beset on all sides by the iniquities of the selfish and the tyranny of evil men. Blessed is he who, in the name of charity and good will, shepherds the weak through the valley of darkness, for he is truly his brother's keeper and the finder of lost children. And I will strike down upon thee with great vengeance and furious anger those who would attempt to poison and destroy My brothers. And you will know My name is the Lord when I lay My vengeance upon thee.";
    }
    return msg;
}

//Función que escribe el html en el div con ID sandbox
function setSandbox(html) {
    return document.getElementById('sandbox').innerHTML = html;
}

//Muestra la ventana modal
function modalShow() {
  $('#modal-content').modal({
    show: true
  });
}

//Serie de funciones que quedan a la espera del click en su div
$(document).ready(function() {

    //Función para generar el alert cuando se llame
    $("#ver").click(function() {
        alert('Hola Mundo!');
    });

    //Prueba para escapar comillas
    $("#comillas").click(function() {
        const easy = 'Es fácil usar \'comillas simples\' y "comillas dobles"'.toUpperCase();
        setSandbox('<h1 class="text-center lead">' + easy + '</h1>');
    });

    //Lanzamos un prompt para preguntar la edad
    $("#age").click(function() {
        var age = prompt('Dime tu edad'.toLowerCase());
        setSandbox('<h1 class="text-center lead">' + 'Tienes ' + age + ' años.' + '</h1>');
    });

    //Inicializamos dos variables, una con el factorial a calcular y otro que
    //almacenará el resultado
    $("#factorial").click(function() {
        var fact = prompt('Dime el número del que quieres calcular el factorial');
        var resultado = 1;

        for (var i = fact; i > 0; i--) {
            resultado = i * resultado;
        }

        setSandbox('<h1 class="text-center lead">' + 'El resultado es: ' + resultado + '</h1>');
        modalShow();
    });

    $("#concatenar").click(function() {
        var text1 = setString();
        var text2 = setString();
        var text3 = text1 + text2;

        setSandbox('<div class="col-md-6"><h2>Primera Cadena</h2>' + text1 + '</div>' + '<div class="col-md-6"><h2>Segunda Cadena</h2>' + text2 + '</div></div>' + '<div class="row"><div class="col-md-12"><h2>Suma de Cadenas</h2>' + text3 + '</div>');
        modalShow();
    });

    $("#divideString").click(function() {
        var text1 = setString();
        var text2 = text1.substring(0, text1.length / 2);
        var text3 = text1.substring((text1.length / 2) + 1);

        setSandbox('<div class="col-md-6"><h2>Primera Cadena</h2>' + text2 + '</div>' + '<div class="col-md-6"><h2>Segunda Cadena</h2>' + text3 + '</div></div>' + '<div class="row"><div class="col-md-12"><h2>Suma de Cadenas</h2>' + text1 + '</div>');
        modalShow();
    });

    $("#charPosition").click(function() {
        var text = setString();
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

        setSandbox('<div class="col-md-3">' + '<h3 class="text-center lead">Posiciones del carácter: <strong>' + char + '</strong></h3>' + '<ul>' + position + '</ul></div><div class="col-md-9"><h3 class="text-center">Texto a Analizar</h3><p>' + text + '</p></div>');
        modalShow();
    });

    $("#split").click(function() {
        var words = setString().split(" ");
        var list = '';
        for (var i = 0; i < words.length; i++) {
            list += '<li>' + words[i] + '</li>';
        }
        setSandbox('<ul>' + list + '</ul>');
        modalShow();
    });

    $("#stringLength").click(function() {
        setSandbox('<p class="text-center">' + setString().length + '</p>');
        modalShow();
    });

    $("#substring").click(function() {
      var text = setString();
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

      setSandbox('<div class="col-md-6"><h2>Texto original</h2>' + text + '</div>' + '<div class="col-md-6"><h2>Texto recortado</h2>' + cut + '</div>');
      modalShow();
    });
});
