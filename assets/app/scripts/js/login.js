let emailReg = /^[a-z]+(\.[a-z]+)+(\.[1-9][0-9]{0,3}\.(0[0-9]|1[0-8]))?\@ict\.edu\.rs$/;
let passwordReg = /^(?=.*[A-ZŠĐČĆa-zžšđčć])(?=.*\d)(?=.*[@$!%*#?&])[A-ZŽŠĐČĆa-zžšđčć\d@$!%*#?&]{8,120}$/;

$(document).ready(function() {
    $(document).on("focus", "#username", function(){
        $(".wc").hide();
    });

    $(document).on("focus", "#password", function(){
        $(".wc").hide();
    });
});

function checkLoginForm(){

    let email = $("#email").val().trim();
    let password = $("#password").val().trim();
    let errors = [];

    if(!email.match(emailReg)){
        errors.push("Email is not ok!");
        $(".error:eq(0)").addClass("visibleError");
        $(".group7:eq(0)").addClass("redBorder");
    }
    else{
        $(".error:eq(0)").removeClass("visibleError");
        $(".group7:eq(0)").removeClass("redBorder");
    }

    if(!password.match(passwordReg)){
        errors.push("Password is not ok!");
        $(".error:eq(1)").addClass("visibleError");
        $(".group7:eq(1)").addClass("redBorder");
    }
    else{
        $(".error:eq(1)").removeClass("visibleError");
        $(".group7:eq(1)").removeClass("redBorder");
    }

    if(errors.length > 0){
        console.log(errors);
        return false;
    }
    else return true;
}