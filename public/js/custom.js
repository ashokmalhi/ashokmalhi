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
                last_name: {
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
                last_name: {
                    required: "Please enter last name",
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
                },
            },
            messages: {
                name: {
                    required: "Please enter team name",
                },
            }
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
                    maxlength: 15,
                    equalTo : "#floatingPassword"
                }
            },
            messages: {
                password: {
                    required: "Please enter password",
                    equalTo: "Password and confirm password does not match",
                },
                password_confirmation: {
                    required: "Please enter confirm password",
                    equalTo: "Password and confirm password does not match",
                }
            },
        })
    }
    
    if ($("#coachForm").length > 0) {

        $("#coachForm").validate({
            rules: {
                first_name: {
                    required: true
                },
                last_name: {
                    required: true
                },
                email: {
                    required: true,
                    email : true
                }
            },
            messages: {
                first_name: {
                    required: "Please enter first name",
                },
                last_name: {
                    required: "Please enter last name",
                },
                email: {
                    required: "Please enter email address",
                    email : "Please enter valid email"
                }
            },
        })
    }
    
    if ($("#match").length > 0) {

        jQuery.validator.addMethod("notEqual", function(value, element, param) {
          return this.optional(element) || value != param;
        }, "Team 1 and Team 2 should be different")

        $("#match").validate({
            rules: {
                name: {
                    required: true
                },
                first_team: {
                    notEqual: function(){return $('#second_team').val()}
                },
                match_date : {
                    required: true
                }
            },
            messages: {
                name: {
                    required: "Please enter match name",
                },
                match_date: {
                    required: "Please select match date and time",
                }
            },
        })
    }

});

