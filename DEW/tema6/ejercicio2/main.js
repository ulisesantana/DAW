var html = document.documentElement; //Elemento raíz de la página

var head = html.firstChild;
var body = html.lastChild;
var nodes = [].slice.call(body.childNodes);
var html = [].slice.call(html.childNodes);
/* Otra manera de coger el head y el body
* var head = html.childNodes[0];
* var body = html.childNodes[1];
*/
console.log(nodes);
console.log(nodes.filter(notATextNode));

clean(html, function(array) {
  var text = '';
  for (var i = 0; i < array.length; i++) {
    if (notATextNode(array[i])) {
      text += (array[i].tagName)
        ? '- ' + array[i].tagName + '\n'
        : '';
    }
    if (array[i].childNodes && areNotTextNodes(array[i].childNodes)) {
      var aux = [].slice.call(array[i].childNodes)

      for (var j = 0; j < aux.length; j++) {
        text += (aux[j].tagName)
          ? '  - ' + aux[j].tagName + '\n'
          : '';

        if (aux[j].childNodes && areNotTextNodes(aux[j].childNodes)) {
          var aux2 = [].slice.call(aux[j].childNodes)

          for (var z = 0; z < aux2.length; z++) {
            text += (aux2[z].tagName)
              ? '   - ' + aux2[z].tagName + '\n'
              : '';
          }
        }
      }
    }
  }
  alert(text);
});

clean(html, function(array) {
  var code = 'Esto es esta página en html: \n\n';

  for (var i = 0; i < array.length; i++) {
    code += array[i].outerHTML + '\n';
  }

  document.getElementById('html').innerText = code;
});

// Con esta función limpiamos los nodos de texto vacío y ejecutamos el callback
function clean(array, callback) {
  if (typeof callback === 'function') callback(array.filter(notATextNode));
}

function notATextNode(node) {
  return node.textContent.trim().length > 0 || node.nodeType != 3;
}

function areNotTextNodes(childNodes) {
  var array = [].slice.call(childNodes);
  array = array.filter(notATextNode);
  if (array.length > 0) {
    return true;
  } else {
    return false;
  }
}
