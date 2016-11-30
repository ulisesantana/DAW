function greet(name) {
  return "Hi, I'm " + name;
}

console.log(greet('Ulises'));

function  makeAdjectifier(adjective){
  return string => adjective + ' ' + string;
}

var coolifier = makeAdjectifier('cool');
console.log(coolifier('pennis'));
