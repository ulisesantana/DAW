// return masked string
function maskify(cc) {
  let mask = cc.split('');
  for (let i = 0; i < (mask.length - 4); i++){
    mask[i] = '#';
  }
  return mask.join('');
}

console.log(maskify('12345678901234567')); // return #############4567
