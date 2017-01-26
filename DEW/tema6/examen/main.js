var options = {
     hogar: ['hogar'],
     musica: ['musica'],
     deporte: ['deporte']
   };

   mapaOptions = new Map(Object.entries(options));

   for (let producto of mapaOptions) {
     let aux = [];
     for (var i = 1; i < 4; i++) {
       // Crear productoos
       producto[i] = document.createElement('option');
       aux.push(producto[i]);
       if(i == mapaOptions.size) options[producto[0]] = aux;
     }
   }

function renderProductos(e){
  let select = document.getElementById('producto');
  let products = []

  select.innerHTML = '';
  switch (e.target.value) {
    case 'deporte':
          producto =['balon', 'playeras', 'raqueta'];
          for (var i = 0; i < producto.length; i++) {
            options.deporte[i].value = producto[i];
            options.deporte[i].innerText = producto[i];
            select.appendChild(options.deporte[i]);
          }
      break;
    case 'musica':
          producto =['teclado', 'guitarra', 'bajo'];
          for (var i = 0; i < producto.length; i++) {
            options.musica[i].value = producto[i];
            options.musica[i].innerText = producto[i];
            select.appendChild(options.musica[i]);
          }
      break;
    case 'hogar':
          producto =['mesa', 'silla', 'florero'];
          for (var i = 0; i < producto.length; i++) {
            options.hogar[i].value = producto[i];
            options.hogar[i].innerText = producto[i];
            select.appendChild(options.hogar[i]);
          }
      break;
    default:
          producto =['mesa', 'silla', 'florero'];
          for (var i = 0; i < producto.length; i++) {
            options.hogar[i].value = producto[i];
            options.hogar[i].innerText = producto[i];
            select.appendChild(options.hogar[i]);
          }
      break;
  }

}

function addProductos(){
  let seccion = document.getElementById('tipo').value;
  let producto = document.getElementById('producto').value;
  let cantidad = document.getElementById('cantidad').value;

  let info = [seccion, producto, cantidad];
  console.log(info);
  let row = document.createElement('tr');
  let cell = null;
  for (var i = 0; i < info.length; i++) {
    cell = document.createElement('td');
    cell.innerText = info[i];
    row.appendChild(cell);
  }
  document.getElementById('tabla').appendChild(row);
}

document.getElementById('tipo').addEventListener('change', renderProductos);
document.getElementById('add').addEventListener('click', addProductos);
document.getElementById('delete').addEventListener('click', function(){
  document.getElementById('tabla').innerHTML = '';
});
