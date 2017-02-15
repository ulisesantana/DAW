class Dice{
  constructor(sides){
    this.sides = sides;
  }

  roll(){
    let num = Math.floor(Math.random() * this.sides + 1);
    return num;
  }
}

class Player {
  constructor(){
    this.dice1 = new Dice(6);
    this.dice2 = new Dice(6);
    this.dice3 = new Dice(12);
  }

  rollDices(){
    let roll = [
      this.dice1.roll(),
      this.dice2.roll(),
      this.dice3.roll()
    ];

    return roll;
  }

  win(){
    let roll = this.rollDices();
    let result = '';

    //true si la suma de los dados es mayor o igual a 20
    let sum = (20 <= (roll[0] + roll[1] + roll[2])); 

    //true si los tres dados tienen el mismo valor
    let equals = (roll[0] == roll[1] && roll[1] == roll[2]);

    //true si la suma de los dos D6 es igual al valor del D12
    let luck = (roll[2] == (roll[0] + roll[1]));

    if (sum || equals || luck) {
      result = 'Has ganado!! La tirada fue: ' + roll;
    } else {
      result = 'Has perdido y eres un mierda!! La tirada fue: ' + roll;
    }

    console.log(roll);
    return result;
  }
}
