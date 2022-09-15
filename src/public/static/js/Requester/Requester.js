export default class Requester {
    method;
    body = {};
    constructor() {
    }
    addData(key, value) {
        this.body[key] = value;
    }
    logBody() {
        console.log(this.body);
    }
    fetch() {
        fetch(new URL("artemy.net"), {
            body: 
        });
    }
}
//# sourceMappingURL=Requester.js.map