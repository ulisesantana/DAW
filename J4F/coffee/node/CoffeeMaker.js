module.exports = class CoffeeMaker {
  constructor(coffee, water, owner) {
    this._coffee = coffee;
    this._water = water;
    this._model = 'Single Coffee';
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

  total(){
    return 'Se han servido '+ this._total +' tazas de café.';
  }

  remainCoffee(){
    return 'Hay '+ this.coffee +' unidades de café.';
  }

  remainWater(){
    return 'Hay '+ this.water +' unidades de agua.';
  }

  makeCoffee(){
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
