  var indexedDB = window.indexedDB || window.mozIndexedDB || window.webkitIndexedDB ||  window.msIndexedDB;
  var dataBase = null; // hay que definirlas fuera. Ámbito global

window.onload = function startDB(){
 dataBase = indexedDB.open("object", 1);

 dataBase.onupgradeneeded = function(e) {
     //se crea la base de datos
     alert("creando base de datos");
     var active= dataBase.result;
     //creamos el almacén de objetos 'people' dentro de la base de datos
     var object = active.createObjectStore('people', {keyPath:'id', autoIncrement:true});
     object.createIndex('by_nombre','nombre', {unique:false});
     object.createIndex('by_dni','dni', {unique:true});
   };

 dataBase.onsuccess = function (e) {
  alert("Base de datos cargada");
  cargarDatos();
 };

 dataBase.onerror = function (e) {
  alert("Ha habido un error al intentar cargar la base de datos");
  console.log(e);
 };

}

function insertar() {

  var active = dataBase.result;
  //Se usan transacciones (grupos de instrucciones que se ejecutan todas o ninguna)
  var data = active.transaction(["people"], "readwrite"); //Parámetros:(array de almacenes,modo de transacción (string) ("readonly","readwrite"))

  var object = data.objectStore("people");

    //con put hacemos las inserciones. le pasamos el objeto como parámetro
  var request = object.put ({
      dni : document.querySelector("#dni").value,
      nombre : document.querySelector("#nombre").value,
      apellido : document.querySelector("#apellido").value,
      polla: document.querySelector("#dni").value.length
  });// insertar. La clave primaria no hace falta, lo hace indexedb

    //Tenemos que controlar si al insertar hay algún error y cuál es
  request.onerror = function (e) {
          alert(request.error.name + '\n\n' + request.error.message);
  };

    //Tenemos que comprobar si la transacción se realiza con éxito
    data.oncomplete = function (e) {
      document.querySelector("#dni").value ='';
      document.querySelector("#nombre").value ='';
      document.querySelector("#apellido").value ='';
      alert("Objeto añadido exitosamente");
      cargarDatos();
  };


}


  function cargarDatos() {
    var active = dataBase.result;
    var data = active.transaction(["people"], "readonly");
    var object = data.objectStore("people");
    var elementos = [];
    //abre el almacén people poniendo el cursor al principio
    object.openCursor().onsuccess = function (e) {
      //recorremos todos los objetos
      var result = e.target.result;

      if (result === null) {
        return; //vacío o estamos en el último
      }

      elementos.push(result.value);
      result.continue();//mueve el puntero al siguiente elemento

    };
    console.log(elementos);
    data.oncomplete = function() {
      var outerHTML = '';
      for (var i in elementos) {
        outerHTML += '\n\
        <tr>\n\
            <td>' + elementos[i].dni + '</td>\n\
            <td>' + elementos[i].nombre + '</td>\n\
            <td>' + elementos[i].apellido + '</td>\n\
        </tr>';
      }

      elementos = [];
      document.querySelector("#elementoslista").innerHTML=outerHTML;
    };

  }
