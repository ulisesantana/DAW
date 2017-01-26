const CoffeeMaker = require('./CoffeeMaker.js');

module.exports = class TwiceCoffee extends CoffeeMaker{
  constructor(coffee, water, owner) {
    super(coffee, water, owner);
    this._model = 'Twice Coffee';
    this._total = 0;
  }

  makeCoffee(){
    if (this.water > 1 && this.coffee > 1) {
      this._water-=2;
      this._coffee-=2;
      this._total+=2;
      return console.log('2 cafés servidos.');
    } else {
      return console.log('Materia prima insuficiente');
    }
  }

}
