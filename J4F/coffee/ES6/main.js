class CoffeeMaker {
    constructor(coffee, water, owner) {
        this._coffee = coffee;
        this._water = water;
        this._model = 'Single Coffee';
        this._owner = owner;
        this._total = 0;
    }

    get coffee() {
        return this._coffee;
    }

    set coffee(coffee) {
        return this._coffee += coffee;
    }

    get water() {
        return this._water;
    }

    set water(water) {
        return this._water += water;
    }

    total() {
        return 'Se han servido ' + this._total + ' tazas de café.';
    }

    remainCoffee() {
        return 'Hay ' + this.coffee + ' unidades de café.';
    }

    remainWater() {
        return 'Hay ' + this.water + ' unidades de agua.';
    }

    makeCoffee() {
        if (this.water > 0 && this.coffee > 0) {
            this._water--;
            this._coffee--;
            this._total++;
            return console.log('Café servido.');
        } else {
            return console.log('Materia prima insuficiente');
        }
    }

}

class TwiceCoffee extends CoffeeMaker {
    constructor(coffee, water, owner) {
        super(coffee, water, owner);
        this._model = 'Twice Coffee';
        this._total = 0;
    }

    makeCoffee() {
        if (this.water > 1 && this.coffee > 1) {
            this._water -= 2;
            this._coffee -= 2;
            this._total += 2;
            return console.log('2 cafés servidos.');
        } else {
            return console.log('Materia prima insuficiente');
        }
    }
}

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
