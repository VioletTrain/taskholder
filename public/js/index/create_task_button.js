export function enableCreateTaskButton() {
  let createButton = document.getElementById('create-task');
  let inputs = document.getElementById('inputs');

  createButton.addEventListener('click', function () {
    inputs.style.visibility = inputs.style.visibility === "visible" ? "hidden" : "visible";
  });
}