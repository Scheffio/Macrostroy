export default class Requester {
    method;
    body = new FormData();
    constructor() {
    }
    addData(key, value) {
        this.body.set(key, value);
    }
    logBody() {
        console.log(this.body);
    }
    fetch() {
        fetch(new URL("https://artemy.net/api/v1/test"), {
            method: "POST",
            body: this.body
        })
            .then(r => r.text())
            .then(function (r) {
            console.log(r);
        });
    }
}
//# sourceMappingURL=Requester.js.map