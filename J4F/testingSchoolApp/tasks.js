function render(id, code){
  let html = (code!=null) ? document.getElementById(id).innerHTML = code
    : document.getElementById(id).innerHTML = '<br>';
  return html;
}

//Hacer lo que falta
/*TODO
  - Agrupar tareas por prioridad y ordenarlas por prioridad y tiempo de ejecución
  - Primero lo más prioritario que ocupe menos tiempo
  - Debería añadirse en algún momento el tener en cuenta el deadline.
  - En un futuro el código podría calcular el tiempo hasta el deadline y
    preveer que no te da tiempo hacerlo todo en función a las horas de
    producción que tengas asignadas diariamente y si tiene en cuenta si
    trabajas los fines de semana o no
*/

function printTasks(id,tasks){
  let html ='';

  for (task of tasks) {
    html += '<li>'+task.name+'</li>';
  }

  return render(id,html);
}

function orderTasks(tasks) {
  //Ordenar las tareas primero por tiempo y luego por prioridad
  return tasks;
}

class Task {
  constructor(name, neededTime, priority) {
    this.name = name;
    this.neededTime = neededTime;
    this.priority = priority;
  }

}

var tasks =[
  new Task("Tarea nº1: Baja - 2 min", 2, 4 ),
  new Task("Tarea nº2: Media - 15 min", 15, 3 ),
  new Task("Tarea nº3: Alta - 30 min", 30, 2 ),
  new Task("Tarea nº4: Urgente - 60 min", 60, 1),
  new Task("Tarea nº5: Media - 10 min", 10, 3 )
];

printTasks('disordered',tasks);

var orderedTasks = orderTasks(tasks);
printTasks('ordered',orderedTasks);
