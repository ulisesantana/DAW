var indexedDB = window.indexedDB || window.webkitIndexedDB || window.mozIndexedDB || window.msIndexedDB;
var storeName = 'people';
var dbName = 'PeopleDB';
var IDBTransaction = window.IDBTransaction || window.webkitIDBTransaction;
var db;
// var peopleData = [
//         { name: "John Dow", email: "john@company.com" },
//         { name: "Don Dow", email: "don@company.com" }
//     ];

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
      objectStore.createIndex("email", "email", { unique: true });

      // for (i in peopleData) {
      //     objectStore.add(peopleData[i]);
      // }
  };
}

function addEntry(){
  var name = document.getElementById("name").value;
  var email = document.getElementById("email").value;

  var transaction = db.transaction(storeName, "readwrite");
  var objectStore = transaction.objectStore(storeName);
  var request = objectStore.add({
    name: name,
    email: email
  });
  request.onsuccess = function (e) {
      print();
  };
}

function updateEntry(id){
  console.log(document.getElementById(id).childNodes);
}

function deleteEntry(id) {
  // Si usas una clave primaria incremental debes convertirla a int
  // porque no es lo mismo 1 que "1"
  id = Number(id);

  var transaction = db.transaction(storeName, "readwrite");
  var objectStore = transaction.objectStore(storeName);
  var request = objectStore.delete(id);
  request.onsuccess = function(e) {
    print();
  };
}

function print() {
  var output = document.getElementById("agenda");
  output.innerHTML = "";

  var transaction = db.transaction(storeName, "readwrite");
  var objectStore = transaction.objectStore(storeName);

  var request = objectStore.openCursor();
  request.onsuccess = function(e) {
      var cursor = e.target.result;
      if (cursor) {
          output.innerHTML += `
            <tr id="${cursor.value.id}">
              <td>${cursor.value.name}</td>
              <td>${cursor.value.email}</td>
              <td>
                <i class="fa fa-trash"
                    aria-hidden="true"
                    onclick="deleteEntry(${cursor.value.id})"></i>
              </td>
            </tr>`;
          cursor.continue();
      }
      else {
          console.log("Datos cargados");
      }
  };
}


initDb();
var deleteDB = document.getElementById("delete-db");
var addForm = document.getElementById('add-contact');

addForm.addEventListener("submit", addEntry);

deleteDB.addEventListener("click", function(){
  indexedDB.deleteDatabase(dbName);
  document.getElementById("agenda").innerHTML = "";
});
