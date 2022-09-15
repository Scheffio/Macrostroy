// @ts-ignore
import KeyValue from "/static/Requester/KeyValue.js";
// @ts-ignore
import {HttpMethod} from "/static/Requester/HttpMethod.js";

export default class Requester {
    private method: HttpMethod;
    private body = {};

    constructor() {
    }

    public addData(key: string, value: File);
    public addData(key: string, value: string);
    public addData(key: string, value) {
    }
}