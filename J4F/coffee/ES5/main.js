var CoffeeMaker = function(coffee, water, owner) {
    this._coffee = coffee;
    this._water = water;
    this._model = 'Single Coffee';
    this._owner = owner;
    this._total = 0;
};

CoffeeMaker.prototype.getCoffee = function() {
    return this._coffee;
};

CoffeeMaker.prototype.setCoffee = function(coffee) {
    return this._coffee += coffee;
};

CoffeeMaker.prototype.getWater = function() {
    return this._water;
};

CoffeeMaker.prototype.setWater = function(water) {
    return this._water += water;
};

CoffeeMaker.prototype.total = function() {
    return 'Se han servido ' + this._total + ' tazas de café.';
};

CoffeeMaker.prototype.remainCoffee = function() {
    return 'Hay ' + this.getCoffee() + ' unidades de café.';
};

CoffeeMaker.prototype.remainWater = function() {
    return 'Hay ' + this.getWater() + ' unidades de agua.';
};

CoffeeMaker.prototype.makeCoffee = function() {
    if (this.getWater() > 0 && this.getCoffee() > 0) {
        this._water--;
        this._coffee--;
        this._total++;
        return console.log('Café servido.');
    } else {
        return console.log('Materia prima insuficiente');
    }
};

// Herencia
function TwiceCoffee(coffee, water, owner) {
    CoffeeMaker.call(this, coffee, water, owner);
    this._model = 'Twice Coffee';
};

TwiceCoffee.prototype = Object.create(CoffeeMaker.prototype);
TwiceCoffee.prototype.constructor = TwiceCoffee;

TwiceCoffee.prototype.makeCoffee = function() {
    if (this.getWater() > 1 && this.getCoffee() > 1) {
        this._water -= 2;
        this._coffee -= 2;
        this._total += 2;
        return console.log('2 cafés servidos.');
    } else {
        return console.log('Materia prima insuficiente');
    }
};

var s = new CoffeeMaker(10, 10, 'Ulises');
console.log('Se ha encendido ' + s._model);
console.log(s.remainCoffee());
s.setCoffee(5);
console.log(s.remainCoffee());
s.makeCoffee();
s.makeCoffee();
console.log(s.remainCoffee());
console.log(s.total());
console.log('\n');

var t = new TwiceCoffee(10, 10, 'Ulises');
console.log('Se ha encendido ' + t._model);
console.log(t.remainCoffee());
t.setCoffee(5);
console.log(t.remainCoffee());
t.makeCoffee();
t.makeCoffee();
console.log(t.remainCoffee());
console.log(t.total());
console.log('\n');
