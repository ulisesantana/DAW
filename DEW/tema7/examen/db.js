
if (!localStorage.getItem('bd')) localStorage.setItem('bd','miBD');

var indexedDB = window.indexedDB || window.webkitIndexedDB || window.mozIndexedDB || window.msIndexedDB;
var storeName = 'producto';
var dbName = localStorage.getItem('bd');
var IDBTransaction = window.IDBTransaction || window.webkitIDBTransaction;
var db;


function initDb() {
  var request = indexedDB.open(dbName, 1);
  request.onsuccess = function (e) {
      db = request.result;
      print();
  };

  request.onerror = function (e) {
      console.log("IndexedDB error: "  + e.target.errorCode);
  };

  request.onupgradeneeded = function (e) {
      var objectStore = e.currentTarget.result.createObjectStore( storeName, {
        keyPath: "id", autoIncrement: true
      });

      objectStore.createIndex("name", "name", { unique: false });
      objectStore.createIndex("tipo", "tipo", { unique: false });
      objectStore.createIndex("consumible", "consumible", { unique: false });

  };
}

function addEntry(){
  var name = document.getElementById("name").value;
  var tipo = document.getElementById("tipo").value;
  var consumible = document.getElementById("consumible").value;
  consumible = (consumible == "true") ? true : false;

  var transaction = db.transaction(storeName, "readwrite");
  var objectStore = transaction.objectStore(storeName);
  var request = objectStore.add({
    name: name,
    tipo: tipo,
    consumible: consumible
  });
  request.onsuccess = function (e) {
      print();
  };
}

function deleteEntry(id) {
  id = Number(id);

  var transaction = db.transaction(storeName, "readwrite");
  var objectStore = transaction.objectStore(storeName);
  var request = objectStore.delete(id);
  request.onsuccess = function(e) {
    print();
  };
}

function print() {
  var catalogo = document.getElementById("catalogo");
  var consumibles = document.getElementById("consumibles");
  catalogo.innerHTML = "";
  consumibles.innerHTML = "";

  var transaction = db.transaction(storeName, "readwrite");
  var objectStore = transaction.objectStore(storeName);

  var request = objectStore.openCursor();
  request.onsuccess = function(e) {
      var cursor = e.target.result;
      if (cursor) {
          catalogo.innerHTML += `
            <tr id="${cursor.value.id}">
              <td>${cursor.value.id}</td>
              <td>${cursor.value.name}</td>
              <td>${cursor.value.tipo}</td>
              <td>${cursor.value.consumible}</td>
              <td>
                <i class="fa fa-trash"
                    aria-hidden="true"
                    onclick="deleteEntry(${cursor.value.id})"></i>
              </td>
            </tr>`;
          if(cursor.value.consumible){
            consumibles.innerHTML += `
              <tr id="${cursor.value.id}">
                <td>${cursor.value.id}</td>
                <td>${cursor.value.name}</td>
                <td>${cursor.value.tipo}</td>
              </tr>`;
          }
          cursor.continue();
      }
      else {
          console.log("Datos cargados");
      }
  };
}


initDb();
var deleteDB = document.getElementById("delete-db");
var addForm = document.getElementById('add-producto');

addForm.addEventListener("submit", addEntry);

deleteDB.addEventListener("click", function(){
  indexedDB.deleteDatabase(dbName);
  document.getElementById("catalogo").innerHTML = "";
  document.getElementById("consumibles").innerHTML = "";
});
