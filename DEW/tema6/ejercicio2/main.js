var text = '';

(function() {
  crossingDOM(document.documentElement, text);
  alert(text);
  document.getElementById('html').innerText = document.documentElement.outerHTML;
})();

function crossingDOM(node,text) {
  if (node == null && isATextNode(node)) return;
  writeCode(node.tagName);
  for (var i = 0; i < node.childNodes.length; i++) {
    crossingDOM(node.childNodes[i],text);
  }
}

function isATextNode(node) {
  return !(node.textContent.trim().length > 0 || node.nodeType != 3);
}

function writeCode(tagName){
  text += (tagName) ? '- ' + tagName + '\n' : '';
}
