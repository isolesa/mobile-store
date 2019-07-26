let firstLastNameReg = /^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,15}(\s[A-ZČĆŽŠĐ][a-zčćžšđ]{2,15})*$/;
let usernameReg = /^[A-z0-9_-]{5,60}$/;
let emailReg = /^[a-z]+(\.[a-z]+)+(\.[1-9][0-9]{0,3}\.(0[0-9]|1[0-8]))?\@ict\.edu\.rs$/;
let passwordReg = /^(?=.*[A-ZŠĐČĆa-zžšđčć])(?=.*\d)(?=.*[@$!%*#?&])[A-ZŽŠĐČĆa-zžšđčć\d@$!%*#?&]{8,120}$/;

// Provera username-a i email-a po izlasku iz inputa

$(document).ready(function(){

    $(document).on("focusout","#username",function(){

        let username = $("#username").val();

        $.post(
            "models/app/users/check-username.php",
            {username: username},
            function (data) {
                if (data.status){
                    $(".not-unique:eq(0)").addClass("visibleError");
                    $(".group7:eq(2)").addClass("redBorder");
                }
                else{
                    $(".not-unique:eq(0)").removeClass("visibleError");
                    $(".group7:eq(2)").removeClass("redBorder");
                }

                $(".isExists:eq(0)").val(data.status);
            });
    });

    $(document).on("focusout","#email",function(){

        let email = $("#email").val();

        $.post(
            "models/app/users/check-email.php",
            {email: email},
            function (data) {
                if (data.status){
                    $(".not-unique:eq(1)").addClass("visibleError");
                    $(".group7:eq(3)").addClass("redBorder");
                }
                else{
                    $(".not-unique:eq(1)").removeClass("visibleError");
                    $(".group7:eq(3)").removeClass("redBorder");
                }

                $(".isExists:eq(2)").val(data.status);
            });
    });
});

// Funkcija za proveru unetih podataka u register formu

function checkRegisterForm(){

    let firstName = $("#firstName").val().trim();
    let lastName = $("#lastName").val().trim();
    let username = $("#username").val().trim();
    let isUsernameExists = $(".isExists:eq(0)").val();
    let email = $("#email").val().trim();
    let isEmailExists = $(".isExists:eq(1)").val();
    let password = $("#password").val().trim();
    let repeatPassword = $("#repeatPassword").val().trim();
    let errors = [];

    if(!firstName.match(firstLastNameReg)){
        errors.push("First name is not ok!");
        $(".error:eq(0)").addClass("visibleError");
        $(".group7:eq(0)").addClass("redBorder");
    }
    else{
        $(".error:eq(0)").removeClass("visibleError");
        $(".group7:eq(0)").removeClass("redBorder");
    }

    if(!lastName.match(firstLastNameReg)){
        errors.push("Last name is not ok!");
        $(".error:eq(1)").addClass("visibleError");
        $(".group7:eq(1)").addClass("redBorder");
    }
    else{
        $(".error:eq(1)").removeClass("visibleError");
        $(".group7:eq(1)").removeClass("redBorder");
    }

    if(!username.match(usernameReg)){
        errors.push("Username is not ok!");
        $(".error:eq(2)").addClass("visibleError");
        $(".group7:eq(2)").addClass("redBorder");
    }
    else{
        $(".error:eq(2)").removeClass("visibleError");
        $(".group7:eq(2)").removeClass("redBorder");
    }

    if(!email.match(emailReg)){
        errors.push("Email is not ok!");
        $(".error:eq(3)").addClass("visibleError");
        $(".group7:eq(3)").addClass("redBorder");
    }
    else{
        $(".error:eq(3)").removeClass("visibleError");
        $(".group7:eq(3)").removeClass("redBorder");
    }

    if(!password.match(passwordReg)){
        errors.push("Password is not ok!");
        $(".error:eq(4)").addClass("visibleError");
        $(".group7:eq(4)").addClass("redBorder");
    }
    else{
        $(".error:eq(4)").removeClass("visibleError");
        $(".group7:eq(4)").removeClass("redBorder");
    }

    if(!repeatPassword.match(passwordReg) || password !== repeatPassword || repeatPassword === ""){
        errors.push("Passwords don't match!");
        $(".error:eq(5)").addClass("visibleError");
        $(".group7:eq(5)").addClass("redBorder");
    }
    else{
        $(".error:eq(5)").removeClass("visibleError");
        $(".group7:eq(5)").removeClass("redBorder");
    }

    if(isUsernameExists === "true"){
        errors.push("Username already exists.");
        $(".group7:eq(2)").addClass("redBorder");
    }

    if(isEmailExists === "true"){
        errors.push("Email already exists.");
        $(".group7:eq(3)").addClass("redBorder");
    }

    if(errors.length > 0){
        console.log(errors);
        return false;
    }
    else return true;
}