enableEditContent();

function enableEditContent() {
  let buttons = Array.from(document.getElementsByClassName('edit-button'));

  buttons.map(function (button) {
    button.addEventListener('click', function (e) {
      e.stopPropagation();
      let inputBlock = document.getElementById('input-block');
      let childSpan = this.parentElement.getElementsByTagName('span')[0] ?? null;
      let id = this.id;

      if (inputBlock) {
        inputBlock.remove();

      }

      if (childSpan) {
        childSpan.innerHTML = '<div id="input-block">' +
          '<input id="edit-content" value="' + childSpan.innerHTML + '"/>' +
          '<br/>Mark as completed <input type="checkbox" id="completed"> <button id='  + id + '>Save</button>' +
          '</div>';
      }

      document.getElementById(this.id).addEventListener('click', function (e) {
        e.stopPropagation();

        let request = new XMLHttpRequest();

        let data = {
          'id': id,
          'content': document.getElementById('edit-content').value,
          'completed': document.getElementById('completed').checked
        };

        request.open('PUT', '/task', true);
        request.setRequestHeader('Content-Type', 'application/json');

        request.onload = function () {

          let response = JSON.parse(request.responseText);
          if (typeof response.error != 'undefined') {
            alert(response.error);
          } else if (typeof response.task != 'undefined') {
            window.location.reload();
          } else {
            alert('Server error. Try again.');
          }
        };

        request.send(JSON.stringify(data));
      });

      this.remove();
    });
  });
}