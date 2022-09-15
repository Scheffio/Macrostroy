// @ts-ignore
import Requester from "/static/js/Requester/Requester.js";
const file_input = document.getElementById("file_input");
let request = new Requester();
request.addData("key", "val");
$(file_input).on("change", function () {
    request.addData('file', file_input.files[0]);
});
$("#get_body_button").on("click", function () {
    console.log(file_input.files[0]);
    request.logBody();
});
$("#fetch_button").on("click", function () {
    request.fetch();
});
//# sourceMappingURL=script_module.js.map