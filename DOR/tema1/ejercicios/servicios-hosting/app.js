//Función que escribe el html en el div con ID mirror
function render(id,html) {
  return document.getElementById(id).innerHTML = html;
}

function ctaForm(id) {
var panel = document.getElementById(id)
}

function setProvForm() {
  var html = '';
  var prov = {
    '1' : 'A Coruña',
    '2' : 'Álava',
    '3' : 'Albacete',
    '4' : 'Alicante',
    '5' : 'Almería',
    '6' : 'Asturias',
    '7' : 'Ávila',
    '8' : 'Badajoz',
    '9' : 'Baleares',
    '10' : 'Barcelona',
    '11' : 'Burgos',
    '12' : 'Cáceres',
    '13' : 'Cádiz',
    '14' : 'Cantabria',
    '15' : 'Castellón',
    '16' : 'Ciudad Real',
    '17' : 'Córdoba',
    '18' : 'Cuenca',
    '19' : 'Girona',
    '20' : 'Granada',
    '21' : 'Guadalajara',
    '22' : 'Gipuzkoa',
    '23' : 'Huelva',
    '24' : 'Huesca',
    '25' : 'Jaén',
    '26' : 'La Rioja',
    '27' : 'Las Palmas',
    '28' : 'León',
    '29' : 'Lérida',
    '30' : 'Lugo',
    '31' : 'Madrid',
    '32' : 'Málaga',
    '33' : 'Murcia',
    '34' : 'Navarra',
    '35' : 'Orense',
    '36' : 'Palencia',
    '37' : 'Pontevedra',
    '38' : 'Salamanca',
    '39' : 'Segovia',
    '40' : 'Sevilla',
    '41' : 'Soria',
    '42' : 'Tarragona',
    '43' : 'Santa Cruz de Tenerife',
    '44' : 'Teruel',
    '45' : 'Toledo',
    '46' : 'Valencia',
    '47' : 'Valladolid',
    '48' : 'Vizcaya',
    '49' : 'Zamora',
    '50' : 'Zaragoza'
  }
  for(var key in prov) {
            html += "<option value=" + key  + ">" +prov[key] + "</option>"
        }
  return render('prov',html);
}

function toggleForm(){
  var html =`<i class="fa fa-thumbs-up" aria-hidden="true"></i>`;
  $('#form').toggleClass('hidden');
  if ($('#form').hasClass('hidden')) {
    render('free-cta-text','CONTRATAR');
    render('premium-cta-text','CONTRATAR');
    render('vip-cta-text','CONTRATAR');
  } else {
    render('free-cta-text',html);
    render('premium-cta-text',html);
    render('vip-cta-text',html);
  }
}

function setCol(id){
  switch (id) {
    case 'free':
      var title = 'Yo me lo guiso, yo me lo como'
      var icon = 'fa-rebel';
      var price = '0€<small>¡GRATIS!</small>';
      var reasons = `
      <li class="items">Motivo para contratarnos nº1</li>
      <li class="items">Motivo para contratarnos nº2</li>
      <li class="items">Motivo para contratarnos nº3</li>
      <li class="items">Motivo para contratarnos nº4</li>
      <li class="items">Motivo para contratarnos nº5</li>
      `;
      break;
    case 'premium':
      var title = 'Premium'
      var icon = 'fa-empire';
      var price = '50€<small>/mes</small>';
      var reasons = `
      <li class="items">Motivo para contratarnos nº1</li>
      <li class="items">Motivo para contratarnos nº2</li>
      <li class="items">Motivo para contratarnos nº3</li>
      <li class="items">Motivo para contratarnos nº4</li>
      <li class="items">Motivo para contratarnos nº5</li>
      `;
      break;
    case 'vip':
      var title = 'Business Gromenagüer'
      var icon = 'fa-first-order';
      var price = '100€<small>/mes</small>';
      var reasons = `
      <li class="items">Motivo para contratarnos nº1</li>
      <li class="items">Motivo para contratarnos nº2</li>
      <li class="items">Motivo para contratarnos nº3</li>
      <li class="items">Motivo para contratarnos nº4</li>
      <li class="items">Motivo para contratarnos nº5</li>
      `;
      break;
    default:
      var colHTML = `<div class="col-md-4"></div>`;
      return colHTML;


  }

var colHTML = `
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">`+title+`</h3>
      </div>
      <div class="panel-body">
        <div class="row text-center"><i class="fa `+ icon + ` fa-5x text-primary"></i></div>
        <div class="row">
          <h1 class="text-primary text-center">`+price+`</h1>
        </div>
        <div class="row items">
          <ul class="center">
            `+reasons+`
          </ul>
        </div>
      </div>
      <div id="`+id+`-cta" class="panel-footer">
        <p id="cta-text" class="text-center lead">CONTRATAR</p>
      </div>
    </div>`;

  return colHTML;
}


$(document).ready(function () {
  setProvForm();
  $("#free-cta").click(function() {
    $('#premium,#vip').toggle();
    toggleForm();
  });

  $("#premium-cta").click(function() {
    $('#free,#vip').toggle();
    toggleForm();
  });

  $("#vip-cta").click(function() {
    $('#premium,#free').toggle();
    toggleForm();
  });
});
