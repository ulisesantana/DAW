function write(code){
  let html = (code!=null) ? document.write(code+'<br>')
    : document.write('<br>');
  return html;
}

// EJEMPLO COERCIÓN
var a = [1,2,3];
var b = [1,2,3];
var c = "1,2,3";

write(a == c);
write(b == c);
write(a == b);
write(a === b);
write(c == a);

// FIN EJEMPLO COERCIÓN

/* EJEMPLO DE CLOSURE*/
function makeAdder(x) {
  function add(y) {
    return y + x;
  }
  return add;
}

var plusOne = makeAdder(1);
var plusTen = makeAdder(10);

write('<h3>Ejemplo de Closure:</h3>');
write(plusOne); //Muestra la función que contiene
write(plusTen); //Muestra la función que contiene
write(plusOne(4)); //5 4+1
write(plusOne(9)); //10 9+1
write(plusTen(12)); //22 12+10
write();
/* FIN EJEMPLO DE CLOSURE*/


/* EJEMPLO DE MODULE PATTERN*/
function User() {
  var username, password;

  function doLogin(user, pw) {
    username = user;
    password = pw;
    //Aquí iría toda la lógica del login que nos
    //vamos a saltar porque no es más que un EJEMPLO
  }

  var publicAPI = {
    login: doLogin
  };

  return publicAPI;
}

var ulises = User();
ulises.login('ulisesantana','contraseñaSUPERsegura');
write('<h3>Ejemplo module pattern:</h3>')
write('var ulises =>'+ulises);
write('ulises.username =>'+ulises.username);
write('ulises.password =>'+ulises.password);
write('ulises.publicAPI =>'+ulises.publicAPI);
write('ulises.login =>'+ulises.login);
/* FIN EJEMPLO DE MODULE PATTERN*/
