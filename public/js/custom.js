$(document).ready(function () {

    if ($("#loginForm").length > 0) {

        $("#loginForm").validate({
            rules: {
                email: {
                    required: true
                    , email: true
                },
                password: {
                    required: true
                }
            },
            messages: {
                email: {
                    required: "Please enter email address",
                },
                password: {
                    required: "Please enter password"
                }
            },
        })
    }

});

