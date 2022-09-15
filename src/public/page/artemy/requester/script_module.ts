// @ts-ignore
import Requester from "/static/js/Requester/Requester.js";

const file_input = document.getElementById("file_input");
let request = new Requester()
const fileField = <HTMLInputElement>document.getElementById("file_input");

request.addData('avatar', fileField.files[0]);
$("#get_body_button").on("click", function () {
    request.logBody()
})