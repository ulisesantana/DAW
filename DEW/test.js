// return masked string
function maskify(cc) {
  var cc = cc.split('');
  for (var i = 0; i < (cc.length - 4); i++){
    cc[i] = '#';
  }
  return cc.join('');
}

console.log(maskify('12345678901234567')); // return #############4567
