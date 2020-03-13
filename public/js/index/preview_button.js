import { getInputData } from "./input_data.js";
import { newTaskHtml } from "./new_task_html.js";

export function enablePreviewButton() {
  let previewButton = document.getElementById('preview-button');
  let tasks = document.getElementById('tasks');
  let lastTask = tasks.lastElementChild;
  let preview = true;

  previewButton.addEventListener('click', function () {
    if (!preview) {
      tasks.removeChild(tasks.firstElementChild);
      tasks.appendChild(lastTask);
      preview = true;

      return;
    }

    let inputData = getInputData();

    if (inputData.get('image')) {
      let reader = new FileReader();

      reader.onload = function (e) {
        let image = new Image();

        image.onload = function () {
          let oldWidth = image.width;
          let oldHeight = image.height;
          let ratio = oldWidth / oldHeight;
          let newWidth = 0;
          let newHeight = 0;

          if (oldWidth > oldHeight) {
            newWidth = 320;
            newHeight = Math.floor(newWidth / ratio);
          } else {
            newHeight = 320;
            newWidth = Math.floor(newHeight * ratio);
          }

          inputData.set('imgpath', e.target.result);
          inputData.set('width', newWidth);
          inputData.set('height', newHeight);

          showPreview(inputData);
        };

        image.src = e.target.result;
      };
      reader.readAsDataURL(inputData.get('image'));
    } else {
      showPreview(inputData);
    }

    preview = false;
  });

  function showPreview(inputData) {
    let previewNode = document.createElement('div');

    let task = Object.fromEntries(inputData);

    previewNode.className = 'col-md-4';
    previewNode.id = 'preview';
    previewNode.innerHTML = newTaskHtml(task);

    tasks.removeChild(tasks.lastElementChild);
    tasks.prepend(previewNode);
  }
}

