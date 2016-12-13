class CoffeeMaker {
  constructor(coffee, water, model, owner) {
    this._coffee = coffee;
    this._water = water;
    this._model = model;
    this._owner = owner;
    this._total = 0;
  }

  get coffee(){
    return this._coffee;
  }

  set coffee(coffee){
    return this._coffee += coffee;
  }

  get water(){
    return this._water;
  }

  set water(water){
    return this._water += water;
  }

  get total(){
    return this._total;
  }

  makeCoffee(){
    if (this.water > 0 && this.coffee > 0) {
      this._water--;
      this._coffee--;
      this._total++;
      return console.log('Café servido.');
      console.log(this.coffee);
    } else {
      return console.log('Materia prima insuficiente');
    }
  }


}

let c = new CoffeeMaker(10,10,'CoffeeMaker 3000', 'Ulises Santana Suárez');

console.log(c.coffee);
c.coffee = 5;
console.log(c.coffee);
c.makeCoffee();
console.log(c.coffee);
console.log(c.total);
console.log(c);
