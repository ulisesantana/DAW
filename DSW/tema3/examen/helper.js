// Aplicar <span id="countdown"></span> en donde quieras ponerlo
function countdown(tiempo){
  setInterval(function(){
    document.getElementById("countdown").innerHTML=tiempo;
    tiempo-=1;
  }, 1000);
}
