class Dice{
  constructor(sides){
    this.sides = sides;
  }

  roll(){
    let num = Math.floor(Math.random() * this.sides + 1);
    console.log(num);
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
    let roll = [this.dice1.roll(),this.dice2.roll(),this.dice3.roll()];
    console.log(roll);
    return roll;
  }

  win(){
    let roll = this.rollDices();
    let result = '';
    let sum = (20 <= (roll[0] + roll[1] + roll[2]));
    let equals = (roll[0] == roll[1] && roll[1] == roll[2]);
    let luck = (roll[2] == (roll[0] + roll[1]));

    if (sum || equals || luck) {
      result = 'Has ganado!!';
    } else {
      result = 'Has perdido!!';
    }
    return console.log(result);
  }
}

const ulises = new Player;
ulises.win();
