const CoffeeMaker = require('./CoffeeMaker.js');
const TwiceCoffee = require('./TwiceCoffee.js');

const s = new CoffeeMaker(10,10,'Ulises');
console.log('Se ha encendido '+s._model);
console.log(s.remainCoffee());
s.coffee = 5;
console.log(s.remainCoffee());
s.makeCoffee();
s.makeCoffee();
console.log(s.remainCoffee());
console.log(s.total());
console.log('\n');


const t = new TwiceCoffee(10,10,'Ulises');
console.log('Se ha encendido '+t._model);
console.log(t.remainCoffee());
t.coffee = 5;
console.log(t.remainCoffee());
t.makeCoffee();
t.makeCoffee();
console.log(t.remainCoffee());
console.log(t.total());
console.log('\n');

console.log(s);
console.log(t);
