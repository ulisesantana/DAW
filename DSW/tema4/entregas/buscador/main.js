let carsCache = '';
$(document).ready( () => {
	$.get('main.php', (cars) => {
		carsFilter(null, cars);
		renderCars(cars);
		carsCache = cars;
	});

	$('select').on('change', (e) => {
		let params = {
			'marca': $('#marca').val(),
			'motor': $('#motor').val(),
			'ano': $('#ano').val(),
			'km': $('#km').val(),
			'precio': $('#precio').val(),
		};

		$.post('main.php', params, (cars) => {
			$('.sort').css('color', 'inherit');
			carsFilter(e.target.id, cars);
			renderCars(cars);
			carsCache = cars;
		});
	});

	$('.sort').on('click', (e) => {
		renderCars(carsCache, e.target.id);
		$('.sort').css('color', 'inherit');
		$('#' + e.target.id).css('color', 'black');
	});

});

function renderCars(cars, sortBy) {
	cars = sortCars(cars, sortBy);
	let rows = ``;
	for (car of cars) {
		rows += writeRow(car);
	}
	$('#coches').html(rows);
}

function showCar(id) {
	let carToShow = '';
	for (car of JSON.parse(carsCache)) {
		if (car.ID == id) {
			carToShow = car;
			break;
		}
	}
	let table = `
		<tbody>
	    <tr>
	      <td colspan="2" rowspan="3">
	        <img src="${carToShow.URLImagen}" height="200px">
	      </td>
	      <td colspan="2"><span>Marca</span>: ${carToShow.Marca}</td>
	    </tr>
	    <tr>
	      <td colspan="2"><span>Modelo</span>: ${carToShow.Modelo}</td>
	    </tr>
	    <tr>
	      <td colspan="2"><span>Motor</span>: ${carToShow.Modelo}</td>
	    </tr>
	    <tr>
	      <td><span>Año</span>: ${carToShow.Año}</td>
	      <td><span>Km</span>: ${carToShow.Km}</td>
	      <td colspan="2"><span>Precio</span>: ${carToShow.Precio}</td>
	    </tr>
	    <tr>
	      <td colspan="4"><span>Descripción</span>: ${carToShow.Descripcion}</td>
	    </tr>
		</tbody>`;

	$('#coche').html(table);
	$('#get-xml').html(
		`<a href="main.php?id=${carToShow.ID}">
			<div class="btn">DESCARGAR FICHA</div>
		</a>`
	);
}

function writeRow(car) {
	return `
    <tr id="${car.ID}" onmouseover="showCar(${car.ID})">
      <td>
        <img src="${car.URLImagen}" width="98" height="70">
      </td>
      <td>${car.Marca}</td>
      <td>${car.Modelo}</td>
      <td>${car.Motor}</td>
      <td>${car.Año}</td>
      <td>${car.Km}</td>
      <td>${car.Precio} €</td>
    </tr>`;
}

function writeOptions(options) {
  let html = ``;
  for (option of options) {
    html += `<option value="${option}">${option}</option>`
  }
  return html;
}

function carsFilter(id, cars) {
	switch (id) {
		case 'marca':
			$('#motor').html(selectFilter('motor', cars));
			$('#ano').html(selectFilter('ano', cars));
			$('#km').html(selectFilter('km', cars));
			$('#precio').html(selectFilter('precio', cars));
			break;
		case 'motor':
			$('#ano').html(selectFilter('ano', cars));
			$('#km').html(selectFilter('km', cars));
			$('#precio').html(selectFilter('precio', cars));
			break;
		case 'ano':
			$('#km').html(selectFilter('km', cars));
			$('#precio').html(selectFilter('precio', cars));
			break;
		case 'km|precio':
			$('#precio').html(selectFilter('precio', cars));
			break;
		default:
			$('#marca').html(selectFilter('marca', cars));
			$('#motor').html(selectFilter('motor', cars));
			$('#ano').html(selectFilter('ano', cars));
			$('#km').html(selectFilter('km', cars));
			$('#precio').html(selectFilter('precio', cars));
			break;
	}
}

function selectFilter(selectID, cars) {
	let options = ['TODOS'];
	switch (selectID) {
		case 'marca':
			for (car of JSON.parse(cars)) {
				if (!options.includes(car.Marca)) options.push(car.Marca);
			}
			options.sort();
			break;
		case 'motor':
			for (car of JSON.parse(cars)) {
				if (!options.includes(car.Motor)) options.push(car.Motor);
			}
			options.sort();
			break;
		case 'ano':
			for (car of JSON.parse(cars)) {
				if (!options.includes(car.Año)) options.push(car.Año);
			}
			options.sort((a, b) => a - b);
			break;
		case 'km':
			for (car of JSON.parse(cars)) {
				if (!options.includes(car.Km)) options.push(car.Km);
			}
			options.sort((a, b) => a - b);
			break;
		case 'precio':
			for (car of JSON.parse(cars)) {
				if (!options.includes(car.Precio)) options.push(car.Precio);
			}
      if (options.length == 2) {
        options.shift();
      } else {
        options.sort((a, b) => a - b);
      }
			break;
	}
	return writeOptions(options);
}

// No me siento orgulloso de este switch, pero no me quedaba otra :-(
function sortCars(cars, sortBy) {
	switch (sortBy) {
		case 'marca-up':
			cars = JSON.parse(cars).sort((a, b) => {
				if (a.Marca.toLowerCase() < b.Marca.toLowerCase()) return -1;
				if (a.Marca.toLowerCase() > b.Marca.toLowerCase()) return 1;
				return 0;
			});
			break;
		case 'marca-down':
			cars = JSON.parse(cars).sort((a, b) => {
				if (a.Marca.toLowerCase() > b.Marca.toLowerCase()) return -1;
				if (a.Marca.toLowerCase() < b.Marca.toLowerCase()) return 1;
				return 0;
			});
			break;
		case 'motor-up':
			cars = JSON.parse(cars).sort((a, b) => {
				if (a.Motor.toLowerCase() < b.Motor.toLowerCase()) return -1;
				if (a.Motor.toLowerCase() > b.Motor.toLowerCase()) return 1;
				return 0;
			});
			break;
		case 'motor-down':
			cars = JSON.parse(cars).sort((a, b) => {
				if (a.Motor.toLowerCase() > b.Motor.toLowerCase()) return -1;
				if (a.Motor.toLowerCase() < b.Motor.toLowerCase()) return 1;
				return 0;
			});
			break;
		case 'modelo-up':
			cars = JSON.parse(cars).sort((a, b) => {
				if (a.Modelo.toLowerCase() < b.Modelo.toLowerCase()) return -1;
				if (a.Modelo.toLowerCase() > b.Modelo.toLowerCase()) return 1;
				return 0;
			});
			break;
		case 'modelo-down':
			cars = JSON.parse(cars).sort((a, b) => {
				if (a.Modelo.toLowerCase() > b.Modelo.toLowerCase()) return -1;
				if (a.Modelo.toLowerCase() < b.Modelo.toLowerCase()) return 1;
				return 0;
			});
			break;
		case 'ano-up':
			cars = JSON.parse(cars).sort((a, b) => {
				if (a.Año < b.Año) return -1;
				if (a.Año > b.Año) return 1;
				return 0;
			});
			break;
		case 'ano-down':
			cars = JSON.parse(cars).sort((a, b) => {
				if (a.Año > b.Año) return -1;
				if (a.Año < b.Año) return 1;
				return 0;
			});
			break;
		case 'km-up':
			cars = JSON.parse(cars).sort((a, b) => {
				if (a.Km < b.Km) return -1;
				if (a.Km > b.Km) return 1;
				return 0;
			});
			break;
		case 'km-down':
			cars = JSON.parse(cars).sort((a, b) => {
				if (a.Km > b.Km) return -1;
				if (a.Km < b.Km) return 1;
				return 0;
			});
			break;
		case 'precio-up':
			cars = JSON.parse(cars).sort((a, b) => {
				if (a.Precio < b.Precio) return -1;
				if (a.Precio > b.Precio) return 1;
				return 0;
			});
			break;
		case 'precio-down':
			cars = JSON.parse(cars).sort((a, b) => {
				if (a.Precio > b.Precio) return -1;
				if (a.Precio < b.Precio) return 1;
				return 0;
			});
			break;
		default:
			cars = JSON.parse(cars).sort((a, b) => {
				if (a.Marca.toLowerCase() < b.Marca.toLowerCase()) return -1;
				if (a.Marca.toLowerCase() > b.Marca.toLowerCase()) return 1;
				return 0;
			});
			break;
	}

	return cars;
}
