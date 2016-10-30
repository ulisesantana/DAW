function render(id, code){
  let html = (code!=null) ? document.getElementById(id).innerHTML = code+'<br>'
    : document.getElementById(id).innerHTML = '<br>';
  return html;
}

//Hacer lo que falta
/*TODO
  - Agrupar tareas por prioridad y ordenarlas por prioridad y tiempo de ejecución
  - Primero lo más prioritario que ocupe menos tiempo
  - Plantear cambiar la etiqueta para prioridad por número para que sea más
    y modulable la ordenación de las tareas
  - Debería añadirse en algún momento el tener en cuenta el deadline.
  - En un futuro el código podría calcular el tiempo hasta el deadline y
    preveer que no te da tiempo hacerlo todo en función a las horas de
    producción que tengas asignadas diariamente y si tiene en cuenta si
    trabajas los fines de semana o no
*/

function print(html){
  return html;
}

class Task {
  constructor(name, neededTime, priority) {
    this.name = name;
    this.neededTime = neededTime;
    this.priority = priority;
  }

}

var tasks =[
  new Task("Tarea nº1: Baja - 2 min", 2, "Prioridad baja" ),
  new Task("Tarea nº2: Media - 15 min", 15, "Prioridad media" ),
  new Task("Tarea nº3: Alta - 30 min", 30, "Prioridad alta" ),
  new Task("Tarea nº4: Urgente - 60 min", 60, "Prioridad máxima" ),
  new Task("Tarea nº5: Media - 10 min", 10, "Prioridad media" )
];

var disordered ='';

for (task of tasks) {
  disordered += render('disordered',task.name);
}

render('disordered',disordered);
