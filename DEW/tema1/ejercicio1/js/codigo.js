//Función para generar el alert cuando se llame
function ver(){
  alert('Hola Mundo!');
}
//Alert que se lanza al cargarse el archivo codigo.js
const saludoInvariable = 'Soy el primer script y es fácil usar \'comillas simples\' y "comillas dobles"';
alert(saludoInvariable);

//Lanzamos un prompt para preguntar la edad
function age(){
  var age = prompt('Dime tu edad');
  alert('Tienes '+age+' años.');
}

//Inicializamos dos variables, una con el factorial a calcular y otro que
//almacenará el resultado
var fact = prompt('Dime el número del que quieres calcular el factorial');
var resultado = 1;
for (var i = fact; i > 0; i--) {
  resultado = i * resultado;
}

alert('El resultado es: '+resultado);
