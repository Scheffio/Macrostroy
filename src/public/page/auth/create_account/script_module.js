$("form").on("submit", function (e) {
    e.preventDefault();
    const params = new URLSearchParams(window.location.search);
    fetch("/api/v1/confirm_email_and_create_password", {
        method: 'POST',
        body: JSON.stringify({
            token: params.get('token'),
            selector: params.get('selector'),
            password: $("form input:last").text()
        })
    }).then(function (data) {
        return data.json();
    }).then(function (json) {
        if (json.action === "success") {
            document.location = "/auth";
        }
        else {
            throw new Error();
        }
    });
});
//# sourceMappingURL=script_module.js.map