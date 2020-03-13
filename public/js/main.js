import { enableCreateTaskButton } from "./index/create_task_button.js";
import { enableSubmitButton } from "./index/submit_task_button.js";
import { enableSortLinks } from "./index/sort_links.js";

window.onload = function () {
  enableCreateTaskButton();
  enableSubmitButton();
  enableSortLinks();
};
