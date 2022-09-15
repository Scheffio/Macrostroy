// @ts-ignore
import Requester from "/static/js/Requester/Requester.js";

const file_input = document.getElementById("file_input");
let request = new Requester()
request.addData("key", "val123");
request.addData("key2", "val123");
request.logBody()