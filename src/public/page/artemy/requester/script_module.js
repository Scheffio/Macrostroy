// @ts-ignore
import Requester from "/static/js/Requester/Requester.js";
const file_input = document.getElementById("file_input");
let request = new Requester();
const fileField = document.getElementById("file_input");
request.addData('avatar', fileField.files[0]);
$("#get_body_button").on("click", function () {
    request.logBody();
});
//# sourceMappingURL=script_module.js.map