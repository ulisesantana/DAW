function render(id, code) {
    let html = (code != null) ? document.getElementById(id).innerHTML = code :
        document.getElementById(id).innerHTML = '<br>';
    return html;
}

class Task {
  constructor(name, neededTime, priority) {
    this.name = name;
    this.neededTime = neededTime;
    this.priority = priority;
  }

}

//Hacer lo que falta
/*TODO
  - Hacer más modulable el ordenamiento por prioridad
  - Debería añadirse en algún momento el tener en cuenta el deadline.
  - En un futuro el código podría calcular el tiempo hasta el deadline y
    preveer que no te da tiempo hacerlo todo en función a las horas de
    producción que tengas asignadas diariamente y si tiene en cuenta si
    trabajas los fines de semana o no
*/

function printTasks(id, tasks) {
    let html = '';

    for (task of tasks) {
        html += '<li>' + task.name + '</li>';
    }

    return render(id, html);
}

function sortByTime(tasks) {
    let len = tasks.length;
    for (let i = 0; i < len; i++) {
        for (let j = 0; j < len; j++) {
            if (tasks[i].neededTime < tasks[j].neededTime) {
                let temp = tasks[i];
                tasks[i] = tasks[j];
                tasks[j] = temp;
            }
        }
    }

    return tasks;
}

function checkUrgentPriority(tasks) {
    return tasks.priority == 1;
}

function checkHighPriority(tasks) {
    return tasks.priority == 2;
}

function checkMediumPriority(tasks) {
    return tasks.priority == 3;
}

function checkLowPriority(tasks) {
    return tasks.priority == 4;
}

function orderTasks(tasks) {
    let tempTasks = [
      tasks.filter(checkUrgentPriority),
      tasks.filter(checkHighPriority),
      tasks.filter(checkMediumPriority),
      tasks.filter(checkLowPriority)
    ];

    for (task of tempTasks) {
      task = sortByTime(task);
    }
    tasks = tempTasks[0].concat(tempTasks[1],tempTasks[2],tempTasks[3])

    return tasks;
}


var tasks = [
    new Task("Tarea nº1: Baja - 2 min", 2, 4),
    new Task("Tarea nº2: Media - 15 min", 15, 3),
    new Task("Tarea nº3: Alta - 30 min", 30, 2),
    new Task("Tarea nº4: Urgente - 60 min", 60, 1),
    new Task("Tarea nº5: Alta - 20 min", 20, 2),
    new Task("Tarea nº6: Media - 35 min", 35, 3),
    new Task("Tarea nº7: Alta - 10 min", 10, 2)
];

printTasks('disordered', tasks);

var orderedTasks = orderTasks(tasks);
printTasks('ordered', orderedTasks);
