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
    
    if ($("#addTeam").length > 0) {
        console.log("fds");
        $("#addTeam").validate({
            rules: {
                name: {
                    required: true
                },
                'coach[]': {
                    required: true
                },
                'manager[]': {
                    required: true
                },
                'team_member[]': {
                    required: true
                }
            },
            messages: {
                name: {
                    required: "Please enter team name",
                },
                'coach[]': {
                    required: "Please select coach",
                },
                'manager[]': {
                    required: "Please select manager",
                },
                'team_member[]': {
                    required: "Please select team member",
                }
            },
            debug: true
        })
    }
    
    if ($("#addStat").length > 0) {

        $("#addStat").validate({
            rules: {
                name: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: "Please enter stat name",
                }
            },
        })
    }

    if($('#resetPasswordForm').length > 0){
        $('#resetPasswordForm').validate({
            rules: {
                password: {
                    required: true,
                    minlength: 6,
                    maxlength: 15
                },
                password_confirmation: {
                    required: true,
                    minlength: 6,
                    maxlength: 15
                }
            }
        })
    }

});

