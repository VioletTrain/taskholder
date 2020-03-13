export function newTaskHtml(task) {
  let taskHtml = '<p>Username: <span class="username">' + task.username + '</span>';

  if (task.completed) {
    taskHtml += '<span class="done">✅ DONE</span>';
  }

  taskHtml += '</p><p>Email: <span class="email">' + task.email + '</span></p>'
    + '<p>Content: <span class="content">' + task.content + '</span></p>';

  if (task.imgpath !== '' && typeof task.imgpath !== 'undefined') {
    let width = '';
    let height = '';

    if (typeof task.width !== 'undefined') {
      width += 'width="' + task.width + '"';
      height += 'height="' + task.height + '"';
    }

    taskHtml += '<img class="image" ' + width + ' ' + height + ' src="' + task.imgpath + '" alt="task-image">';
  }

  return taskHtml;
}