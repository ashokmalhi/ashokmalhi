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

        $("#addTeam").validate({
            rules: {
                name: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: "Please enter team name",
                }
            },
        })
    }
    
    if ($("#addStat").length > 0) {

        $("#addStat").validate({
            rules: {
                name: {
                    required: true
                },
                file: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: "Please enter stat name",
                },
                file: {
                    required: "Please upload file",
                }
            },
        })
    }
    
    if ($("#uploadPlayers").length > 0) {

        $("#uploadPlayers").validate({
            rules: {
                file: {
                    required: true
                }
            },
            messages: {
                file: {
                    required: "Please upload file",
                }
            },
        })
    }

});

