window.onload = function () {
  enableLoginForm();
};

function enableLoginForm() {
  let data = new FormData();
  let request = new XMLHttpRequest();
  let submitButton = document.getElementById('login-submit');

  submitButton.addEventListener('click', function () {
    Array.from(document.getElementsByClassName('input')).map(function (input) {
      data.append(input.id.replace('input-', ''), input.value);
    });

    request.open('POST', '/admin/login', false);
    request.send(data);

    request.onload = function () {
      let response = JSON.parse(request.responseText);

      if (typeof response.error != 'undefined') {
        alert(response.error);
      } else if (typeof response.admin != 'undefined') {
        window.location.href = '/';
      } else {
        alert('Server error. Try again.');
      }
    };
  });
}