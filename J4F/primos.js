console.log('Hora de inicio: '+new Date);
let file = require("fs");
let primos = [];
let aux = [];
let lim = 50000;

for (let i = 1; i <= lim; i++) {
  aux = [];
  for (let j = i; j > 0 ; j--) {
    if(i%j == 0 && j != 0 && j != 1) {
      aux.push(i);
    }
    if(j == 1 && aux.length == 1) primos.push(i);
  }
  if(i == lim) {
    let text = '';
    for (num of primos) {
      text += num+'\n';
    }
    file.writeFile("./primos.txt", text, (err) => {
      if (err) throw err;
      console.log('Hora de fin: '+new Date);
    });
  }
}
