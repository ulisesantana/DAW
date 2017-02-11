//Calcula el tiempo de carga de una página.

var beforeload = (new Date()).getTime();



function getPageLoadTime(){

        var afterload = (new Date()).getTime();

        seconds = (afterload-beforeload) / 1000;

        $('#load_time').text('Tiempo de carga de la página ::  ' + seconds + ' sec(s).');

}

window.onload = getPageLoadTime;