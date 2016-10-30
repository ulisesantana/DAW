//Función que escribe el html en el div con ID mirror
function setSandbox(html) {
  return document.getElementById('mirror').innerHTML = html;
}

$(document).ready(function () {

  $("#env").click(function() {
    var html=$( "#input1").val();
    setSandbox(html);
    $('#mirror').toggleClass('hidden');
  });

  $("#img").click(function() {
    $('#batman').toggle();
  });

  $("#img").hover(function() {
    $('#batman').toggleClass('transp');
  });

  $("#target").click(function() {
    $('a[target="_blank"').toggleClass("blank");
  });
});
