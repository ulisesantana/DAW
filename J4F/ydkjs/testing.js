function write(html){
  return document.write(html+'<br>');
}

function foo () {
  var a = 1 ;
  write('a => ' + a);
  if ( a >= 1 ) {
    let b = 2 ;
    let i = 1;
    while ( b < 5 ) {
      let c = b * 2 ;
      write('b => ' + b + '. Vuelta: '+ i);
      write('a + c => '+(a + c)+'. Vuelta: '+i);
      b++;
      i++;
    }
    write(b);
    write(a);
  }
  write(b);
}

foo (); // 5 7 9
