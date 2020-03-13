export function getInputData() {
  let data = new FormData();
  let image = document.getElementById('input-image').files[0] ?? null;

  Array.from(document.getElementsByClassName('input')).map(function (input) {
    data.append(input.id.replace('input-', ''), input.value);
  });

  if (image) {
    data.append('image', image);
  }

  return data;
}