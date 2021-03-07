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
    
    if ($("#playerForm").length > 0) {

        $("#playerForm").validate({
            rules: {
                first_name: {
                    required: true
                },
                email: {
                    required: true,
                    email : true
                },
                player_no: {
                    required: true,
                }
            },
            messages: {
                first_name: {
                    required: "Please enter first name",
                },
                email: {
                    required: "Please enter email address",
                    email : "Please enter valid email"
                },
                player_no: {
                    required: "Please enter player no",
                }
            },
        })
    }

});

