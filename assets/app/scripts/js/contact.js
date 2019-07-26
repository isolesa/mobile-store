let firstLastNameReg = /^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,15}(\s[A-ZČĆŽŠĐ][a-zčćžšđ]{2,15})*$/;
let emailReg = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
let subjectReg = /^[A-Za-z0-9 .'?!,@$#-_\n\r]{2,200}$/;

$(document).ready(function(){
    $(document).on("click","#sendMessageBtn",validateContact);
});

function validateContact(){

    let name = $("#firstLastName").val().trim();
    let email = $("#contactEmail").val().trim();
    let subject = $("#subject").val().trim();
    let dataObj = new Object();
    let errors = [];

    if(!name.match(firstLastNameReg)){
        errors.push("Name is not ok!");
        $(".errorContact:eq(0)").addClass("visibleError");
        $(".contactInput:eq(0)").addClass("redBorder");
    }
    else{
        $(".errorContact:eq(0)").removeClass("visibleError");
        $(".contactInput:eq(0)").removeClass("redBorder");
        dataObj.name = name;
    }

    if(!email.match(emailReg)){
        errors.push("Email is not ok!");
        $(".errorContact:eq(1)").addClass("visibleError");
        $(".contactInput:eq(1)").addClass("redBorder");
    }
    else{
        $(".errorContact:eq(1)").removeClass("visibleError");
        $(".contactInput:eq(1)").removeClass("redBorder");
        dataObj.email = email;
    }

    if(!subject.match(subjectReg)){
        errors.push("Subject is not ok!");
        $(".errorContact:eq(2)").addClass("visibleError");
        $(".contactInput:eq(2)").addClass("redBorder");
    }
    else{
        $(".errorContact:eq(2)").removeClass("visibleError");
        $(".contactInput:eq(2)").removeClass("redBorder");
        dataObj.subject = subject;
    }

    if(errors.length > 0){
        console.log(errors);
    }
    else sendMessage(dataObj);
}

function sendMessage(data){

    $.ajax({
        url:"models/app/contact/send-message.php",
        method:"POST",
        data:data,
        success:function(data,statusText,jqXHR){
           if(jqXHR.status === 201)
               $(".successMessage").html("Message sent!");
           },
        error:function(jqXHR){
            console.log(jqXHR.status);
        }
    });
}