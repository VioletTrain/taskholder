window.onload = function () {
  enableCreateTaskButton();
  enableSubmitButton();
  enableSortLinks();
};

function enableCreateTaskButton() {
  let createButton = document.getElementById('create-task');
  let inputs = document.getElementById('inputs');

  createButton.addEventListener('click', function () {
    inputs.style.visibility = inputs.style.visibility === "visible" ? "hidden" : "visible";
  });
}

function enableSubmitButton() {
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

    request.onreadystatechange = function () {
      console.log(request.responseText);
    };

    request.send(data);
  });
}

function enableSortLinks() {
  let url = new URL(window.location.href);
  let currentSort = url.searchParams.get('sort') ?? 'created_at';
  let currentOrder = url.searchParams.get('order') ?? 'desc';
  let sortLinks = Array.from(document.getElementsByClassName('sort-link'));

  sortLinks.map(function (link) {
    if (currentSort === link.id.replace('sort-', '') && currentOrder === 'asc') {
      link.href += '&order=desc';
    } else {
      link.href += '&order=asc';
    }
  });
}