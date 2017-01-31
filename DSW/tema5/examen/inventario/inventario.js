document.getElementById('marcaBuscar').addEventListener('change', exportarCSV);

function buscarPortatiles() {
  var marca = document.getElementById('marcaBuscar').value;
  var xhr	= new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        if (this.responseText.includes('Error')) {
          alert(this.responseText);
        } else {
          document.getElementById('divPortatiles').innerHTML = this.responseText; // la tabla me la devuelve hay
        }

      }
    };
  xhr.open("POST", "inventario.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  var parametros = "accion=buscar" + "&marcaBuscar=" + marca;
  xhr.send(parametros);
}

function exportarCSV() {
  var marca = document.getElementById('marcaBuscar').value;
  document.getElementById('csv').href = "inventario.php?accion=descargar&marca="+marca;
}

function eliminarPortatiles() {
  var marca = document.getElementById('marcaBuscar').value;
  var portatiles = getChecked();
  var xhr	= new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        if (this.responseText.includes('Error')) {
          alert(this.responseText);
        } else {
          document.getElementById('divPortatiles').innerHTML = this.responseText; // la tabla me la devuelve hay
        }

      }
    };
  xhr.open("POST", "inventario.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  var parametros = "accion=eliminar"+ "&marcaBuscar=" + marca + "&portatiles=" + portatiles;
  xhr.send(parametros);
}

function insertarPortatil() {
  var marca = document.getElementById('marca').value;
  var procesador = document.getElementById('procesador').value;
  var ram = document.getElementById('RAM').value;
  var disco = document.getElementById('disco').value;
  var xhr	= new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        if (this.responseText.includes('Error')) {
          alert(this.responseText);
        } else {
          document.getElementById('divPortatiles').innerHTML = this.responseText; // la tabla me la devuelve hay
        }

      }
    };
  xhr.open("POST", "inventario.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  var parametros = "accion=insertar"+
                    "&marca=" + marca +
                    "&procesador=" + procesador +
                    "&RAM=" + ram +
                    "&disco=" + disco;
  xhr.send(parametros);
}

function getChecked(){
  var inputs = document.getElementsByTagName('input');
  var checkboxs = [];
  for (var i = 0; i < inputs.length; i++) {
    if (inputs[i].type == "checkbox" && inputs[i].checked) {
      checkboxs.push(inputs[i].id);
    }
  }
  checkboxs = checkboxs.join(',');
  return checkboxs;
}
