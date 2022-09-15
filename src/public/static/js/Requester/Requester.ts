// @ts-ignore
import KeyValue from "/static/js/Requester/KeyValue.js";
// @ts-ignore
import {HttpMethod} from "/static/js/Requester/HttpMethod.js";

export default class Requester {
    private method: HttpMethod;
    public body = new FormData();

    constructor() {
    }

    public addData(key: string, value: File);
    public addData(key: string, value: string);
    public addData(key: string, value) {
        this.body.set(key, value)
    }

    public logBody() {
        console.log(this.body)
    }

    public fetch() {
        fetch(new URL("https://artemy.net/api/v1/test"), {
            method: "POST",
            body: this.body
        })
            .then(r => r.text())
            .then(function (r) {
            console.log(r)
        })
    }
}