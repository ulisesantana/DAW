function render(id,html) {
  return document.getElementById(id).innerHTML = html;
}

class Concesionario {
  constructor(office, city, manager) {
    this.office = office;
    this.city = city;
    this.manager = manager;
  }
}

class Coche {
  constructor(marca, modelo, anio, concesionario) {
    this.marca = marca;
    this.modelo = modelo;
    this.anio = anio;
    this.concesionario = concesionario;
  }

  print(){
    return `
      <tr>
        <td>${this.marca}</td>
        <td>${this.modelo}</td>
        <td>${this.anio}</td>
        <td>${this.concesionario.office}</td>
      </tr>`;
  }
}


var concesionario = new Concesionario('Orlando Rent a Car', 'Sardina', 'Adrián Santana');

var coches = [
  new Coche('Opel','Corsa','2007',concesionario),
  new Coche('Volkswagen','Golf','2013',concesionario),
  new Coche('Mercedes','Vito','2016',concesionario),
  new Coche('Peugeot','206','2004',concesionario)
];

(function () {
  var html = '';
  for (coche of coches) {
    html += coche.print();
  }
  return render('cars',html);
})(); //IIEF
