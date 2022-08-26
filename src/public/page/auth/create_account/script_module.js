$("form").on("submit", function () {
    const params = new URLSearchParams(window.location.search);
    fetch("/api/v1/confirm_email_and_create_password", {
        method: 'POST',
        body: JSON.stringify({
            token: params.get('token'),
            selector: params.get('selector'),
            password: $("form input:last").text()
        })
    });
});
//# sourceMappingURL=script_module.js.map