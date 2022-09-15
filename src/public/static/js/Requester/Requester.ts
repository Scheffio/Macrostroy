// @ts-ignore
import KeyValue from "/static/js/Requester/KeyValue.js";
// @ts-ignore
import {HttpMethod} from "/static/js/Requester/HttpMethod.js";

export default class Requester {
    private method: HttpMethod;
    public body = {};

    constructor() {
    }

    public addData(key: string, value: File);
    public addData(key: string, value: string);
    public addData(key: string, value) {
        this.body[key] = value;
    }

    public logBody() {
        console.log(this.body)
    }

    public fetch() {
        fetch(new URL("artemy.net"), {
            body: 
        })
    }
}