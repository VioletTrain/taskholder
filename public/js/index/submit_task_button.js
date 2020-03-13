import { getInputData } from "./input_data.js";
import { newTaskHtml } from "./new_task_html.js";

export function enableSubmitButton() {
  let submitButton = document.getElementById('submit');

  submitButton.addEventListener('click', function () {
    let data = getInputData();
    let request = new XMLHttpRequest();

    request.open('POST', '/task', true);
    request.send(data);

    request.onload = function () {
      let response = JSON.parse(request.responseText);

      if (typeof response.error != 'undefined') {
        alert(response.error);
      } else if (typeof response.task != 'undefined') {
        if (typeof response.task.imgpath !== 'undefined' && response.task.imgpath !== '') {
          response.task.imgpath = '/storage/img/' + response.task.imgpath;
        }

        appendTask(response.task);
        alert('Successfully created task.')
      } else {
        alert('Server error. Try again.');
      }
    };
  });
}

function appendTask(task) {
  let tasks = document.getElementById('tasks');
  let preview = document.getElementById('preview');
  let newTaskNode = document.createElement('div');

  newTaskNode.className = 'col-md-4 task';
  newTaskNode.innerHTML = newTaskHtml(task);

  if (preview){
    tasks.removeChild(preview);
  } else {
    tasks.removeChild(tasks.lastElementChild);
  }

  tasks.prepend(newTaskNode);
}