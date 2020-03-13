export function enableSubmitButton() {
  let submitButton = document.getElementById('submit');

  submitButton.addEventListener('click', function () {
    let data = new FormData();
    let request = new XMLHttpRequest();
    let image = document.getElementById('input-image').files[0] ?? null;

    Array.from(document.getElementsByClassName('input')).map(function (input) {
      data.append(input.id.replace('input-', ''), input.value);
    });

    if (image) {
      data.append('image', image);
    }

    request.open('POST', '/task', true);
    request.send(data);

    request.onload = function () {
      let response = JSON.parse(request.responseText);

      if (typeof response.error != 'undefined') {
        alert(response.error);
      } else if (typeof response.task != 'undefined') {
        appendTask(response.task);
      } else {
        alert('Server error. Try again.');
      }
    };
  });
}

function appendTask(task) {
  let tasks = document.getElementById('tasks');
  let newTaskNode = tasks.children.item(0).cloneNode();

  newTaskNode.innerHTML = '<p>Username: <span class="username">' + task.username + '</span>';

  if (task.completed) {
    newTaskNode.innerHTML += '<span class="done">✅ DONE</span>';
  }

  newTaskNode.innerHTML += '</p><p>Email: <span class="email">' + task.email + '</span></p>'
    + '<p>Content: <span class="content">' + task.content + '</span></p>';

  if (task.imgpath !== '') {
    newTaskNode.innerHTML += '<img class="image" src="/storage/img/' + task.imgpath + '" alt="task-image">'
  }

  tasks.removeChild(tasks.lastElementChild);
  tasks.prepend(newTaskNode);
}