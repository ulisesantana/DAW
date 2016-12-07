let num = [];
for (let i = 0; i < 10; i++) num[i] = Math.floor(Math.random() * 100 + 1);

//Usando un método de ordenación propia
function customSort(array){
  let len = array.length;
  for (let i = 0; i < array.length - 1; i++) {
    let min = array[i];
    let pos = i;
    for (let j = i+1; j < array.length - 1; j++) {
      if (array[j] < min) {
        min = array[j];
        pos = j;
      }
    }
    let aux = array[i];
    array[i] = min;
    array[pos] = aux;
  }
  return array;
}

//Usando funciones del lenguaje
console.log('sort() => ' + num.sort((a,b)=>a-b));
console.log('customSort() => ' + customSort(num));
