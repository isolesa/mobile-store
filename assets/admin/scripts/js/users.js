$(document).ready(function(){

    $(document).on("click",".update",function(){

        let userId = $(this).attr("data-id");

        $.ajax({
            url:"models/admin/users/get-user.php",
            method:"POST",
            data:{userId:userId},
            success:function(data){
                modalContentView(data);
                },
            error:function(xhr, status, error){
                console.log(status + ': ' + error);
            }
        });
    });

    $(document).on("focusout",".username",function(){

        let username = $(".username").val();

        $.post(
            "models/app/users/check-username.php",
            {username: username},
            function(data){
                if(data.status)
                    $(".username").addClass("redBorder");
                else
                    $(".username").removeClass("redBorder");

                $(".isExists:eq(1)").val(data.status);
            });
    });

    $(document).on("focusout",".email",function(){

        let email = $(".email").val();

        $.post(
            "models/app/users/check-email.php",
            {email: email},
            function(data){
                if (data.status)
                    $(".email").addClass("redBorder");
                else
                    $(".email").removeClass("redBorder");

                $(".isExists:eq(0)").val(data.status);
            });
    });

    $(document).on("click","#addUserBtn",addUser);
    $(document).on("click","#updateUserBtn",updateUser);
    $(document).on("click","#deleteUserBtn",deleteUser);
});

function modalContentView(user){

    let content = `<div class="row" style="padding-top:10px;"><div class="text-muted text-center mt-2 mb-3"><h4>${user.firstName} ${user.lastName}</h4></div></div><div class="row" style="padding:0 20px 0 20px; margin-top:10px;"><div class="col-lg-6"><label>First name:</label><input type="text" class="form-control form-control-alternative firstNameUpdate exampleFormControlInput1" value="${user.firstName}"><label>E-mail:</label><input type="text" class="form-control form-control-alternative email exampleFormControlInput1" value="${user.email}" disabled><label for="example-date-input" class="col-6 col-form-label">Date Of Birth:</label><div class="col-10"><input class="form-control dateOfBirthUpdate" type="date" value="${user.dateOfBirth}" id="example-date-input"></div><label>Profile photo:</label><br><img src="` + BASE_URL + `/assets/app/images/users/profile/big/${user.imageBig}" alt="${user.firstName} ${user.lastName}" class="img-thumbnail profileImg"><br><button type="button" onclick="document.getElementById('profilePhotoUpdate').click()" class="btn btn-facebook">Change profile photo</button><span id="profilePhotoValue"></span><input type="file" name="slika" id="profilePhotoUpdate" style="display:none;" onchange="document.getElementById('profilePhotoValue').innerHTML=this.value;"/></div><div class="col-lg-6 ml-auto"><label>Last name:</label><input type="text" class="form-control form-control-alternative lastNameUpdate exampleFormControlInput1" value="${user.lastName}"><label>Username:</label><input type="text" class="form-control form-control-alternative username exampleFormControlInput1" value="${user.username}" disabled><label>Role:</label><br>`;

    if(user.roleName === "Administrator")

        content += `<div class="custom-control custom-radio mb-3"><input name="custom-radio-2" class="custom-control-input roleUpdate" id="customRadio5" type="radio" value="2" checked><label class="custom-control-label" for="customRadio5" style="margin-top:5px !important;">Administrator</label></div><div class="custom-control custom-radio mb-3"><input name="custom-radio-2" class="custom-control-input roleUpdate" id="customRadio6" type="radio" value="3"><label class="custom-control-label" for="customRadio6" style="margin-top:5px !important;">User</label></div>`;

    else if(user.roleName === "User")

        content += `<div class="custom-control custom-radio mb-3"><input name="custom-radio-2" class="custom-control-input roleUpdate" id="customRadio5" type="radio" value="2"><label class="custom-control-label" for="customRadio5" style="margin-top:5px !important;">Administrator</label></div><div class="custom-control custom-radio mb-3"><input name="custom-radio-2" class="custom-control-input roleUpdate" id="customRadio6" type="radio" value="3" checked><label class="custom-control-label" for="customRadio6" style="margin-top:5px !important;">User</label></div>`;

        content += `</div></div><div class="row"><div class="col-lg-12"><button type="button" class="btn btn-facebook my-4" style="float:right; margin-right: 20px;" id="updateUserBtn" data-id="${user.userId}">Change</button></div></div>`;

        $("#updateModal").html(content);
}

function addUser(){

    let firstLastNameReg = /^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,15}(\s[A-ZČĆŽŠĐ][a-zčćžšđ]{2,15})*$/;
    let usernameReg = /^[A-z0-9_-]{5,60}$/;
    let emailReg = /^[a-z]+(\.[a-z]+)+(\.[1-9][0-9]{0,3}\.(0[0-9]|1[0-8]))?\@ict\.edu\.rs$/;
    let passwordReg = /^(?=.*[A-ZŠĐČĆa-zžšđčć])(?=.*\d)(?=.*[@$!%*#?&])[A-ZŽŠĐČĆa-zžšđčć\d@$!%*#?&]{8,120}$/;

    let firstName = $(".firstName").val();
    let lastName = $(".lastName").val();
    let email = $(".email").val();
    let username = $(".username").val();
    let password = $(".password").val();
    let repeatPassword = $(".repeatPassword").val();
    let dateOfBirth = $(".dateOfBirth").val();
    let role = $("[name=custom-radio-2]:checked").val();
    let isEmailExists = $(".isExists:eq(0)").val();
    let isUsernameExists = $(".isExists:eq(1)").val();
    let formData = new FormData();
    let image = $("#profilePhoto")[0].files[0];

    formData.append("file",image);
    formData.append("firstName",firstName);
    formData.append("lastName",lastName);
    formData.append("email",email);
    formData.append("username",username);
    formData.append("password",password);
    formData.append("repeatPassword",repeatPassword);
    formData.append("dateOfBirth",dateOfBirth);
    formData.append("role",role);

    let url = "models/admin/users/insert.php";
    let errors = [];

    if(!firstName.match(firstLastNameReg)){
        errors.push("First name is not ok!");
        $(".firstName").addClass("redBorder");
    }
    else $(".firstName").removeClass("redBorder");

    if(!lastName.match(firstLastNameReg)){
        errors.push("Last name is not ok!");
        $(".lastName").addClass("redBorder");
    }
    else $(".lastName").removeClass("redBorder");

    if(!username.match(usernameReg)){
        errors.push("Username is not ok!");
        $(".username").addClass("redBorder");
    }
    else $(".username").removeClass("redBorder");

    if(!email.match(emailReg)){
        errors.push("Email is not ok!");
        $(".email").addClass("redBorder");
    }
    else $(".email").removeClass("redBorder");

    if(!password.match(passwordReg)){
        errors.push("Password is not ok!");
        $(".password").addClass("redBorder");
    }
    else $(".password").removeClass("redBorder");

    if(!repeatPassword.match(passwordReg) || password !== repeatPassword || repeatPassword === ""){
        errors.push("Passwords don't match!");
        $(".repeatPassword").addClass("redBorder");
    }
    else $(".repeatPassword").removeClass("redBorder");

    if(isUsernameExists === "true"){
        errors.push("Username already exists.");
        $(".username").addClass("redBorder");
    }

    if(isEmailExists === "true"){
        errors.push("Email already exists.");
        $(".email").addClass("redBorder");
    }

    if(errors.length > 0){
        console.log(errors);
    }
    else sendUserData(formData, url);
}

function sendUserData(data, url){

    $.ajax({
        url:url,
        method:"POST",
        cache: false,
        contentType:false,
        processData:false,
        data:data,
        success:function(response, statusText, jqXHR){
            if(jqXHR.status === 201 || jqXHR.status === 204) getUsers();
            },
        error:function(jqXHR, status, error){
            console.log(jqXHR.status);
        }
    });
}

function getUsers(){

        $.ajax({
            url:"models/admin/users/get-users.php",
            method:"GET",
            dataType:"json",
            success:function(data){
                $("#modal-insert").modal("hide");
                $("#modal-update").modal("hide");
                printUsers(data);
                clearModalInsert();
                },
            error:function(xhr, status, error){
                console.log(status + ': ' + error);
            }
        });
}

function printUsers(data){

    let content = "";

    for(let user of data){

        if(user.dateOfBirth === null) user.dateOfBirth = "";

        content += `<tr><td>${user.firstName}</td><td>${user.lastName}</td><td>${user.username}</td><td>${user.email}</td><td>${user.dateOfBirth}</td><td>${user.dateOfRegistration}</td><td>${user.roleName}</td><td>${user.active}</td><td class="text-right">`;

            if(user.userId !== "1")

                content += `<div class="dropdown"><a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a><div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow"><button class="dropdown-item update" data-id="${user.userId}" data-toggle="modal" data-target="#modal-update">Update</button><button class="dropdown-item" href="#" id="deleteUserBtn" data-id="${user.userId}">Delete</button></div></div>`;

            content += `</td></tr>`;
    }

    $("#usersTbody").html(content);
}

function updateUser(){

    let userId = $("#updateUserBtn").attr("data-id");
    let firstLastNameReg = /^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,15}(\s[A-ZČĆŽŠĐ][a-zčćžšđ]{2,15})*$/;
    let firstName = $(".firstNameUpdate").val();
    let lastName = $(".lastNameUpdate").val();
    let dateOfBirth = $(".dateOfBirthUpdate").val();
    let role = $("[name=custom-radio-2]:checked").val();
    let formData = new FormData();
    let image = $("#profilePhotoUpdate")[0].files[0];

    formData.append("file",image);
    formData.append("firstName",firstName);
    formData.append("lastName",lastName);
    formData.append("dateOfBirth",dateOfBirth);
    formData.append("role",role);
    formData.append("userId",userId);

    let url = "models/admin/users/update.php";
    let errors = [];

    if(!firstName.match(firstLastNameReg)){
        errors.push("First name is not ok!");
        $(".firstName").addClass("redBorder");
    }
    else $(".firstName").removeClass("redBorder");

    if(!lastName.match(firstLastNameReg)) {
        errors.push("Last name is not ok!");
        $(".lastName").addClass("redBorder");
    }
    else $(".lastName").removeClass("redBorder");

    if(errors.length > 0){
        console.log(errors);
    }
    else sendUserData(formData, url);
}

function deleteUser(){

    let userId = $(this).attr("data-id");
    let formData = new FormData();
    formData.append("userId",userId);
    let url = "models/admin/users/delete.php";

    sendUserData(formData, url);
}

function clearModalInsert(){

    let content = `<div class="row" style="padding:0 20px 0 20px; margin-top:10px;"><div class="col-lg-6"><label>First name:</label><input type="text" class="form-control form-control-alternative firstName exampleFormControlInput1" placeholder="First name"><label>E-mail:</label><input type="text" class="form-control form-control-alternative email exampleFormControlInput1" placeholder="E-mail"><input type="hidden" class="form-control isExists" value=""/><label for="example-date-input" class="col-6 col-form-label">Date Of Birth:</label><div class="col-10"><input class="form-control dateOfBirth" type="date" value="1993-08-19" id="example-date-input"></div><label>Profile photo:</label><br><button type="button" onclick="document.getElementById('profilePhoto').click()" class="btn btn-facebook">Add profile photo</button><span id="profilePhotoValue"></span><input type="file" name="slika" id="profilePhoto" style="display:none;" onchange="document.getElementById('profilePhotoValue').innerHTML=this.value;"/></div><div class="col-lg-6 ml-auto"><label>Last name:</label><input type="text" class="form-control form-control-alternative lastName exampleFormControlInput1" placeholder="Last name"><label>Username:</label><input type="text" class="form-control form-control-alternative username exampleFormControlInput1" placeholder="Username"><input type="hidden" class="form-control isExists" value=""/><label>Password:</label><input type="password" class="form-control form-control-alternative password exampleFormControlInput1" placeholder="Password"><label>Repeat password:</label><input type="password" class="form-control form-control-alternative repeatPassword exampleFormControlInput1" placeholder="Repeat password"><label>Role:</label><br><div class="custom-control custom-radio mb-3"><input name="custom-radio-2" class="custom-control-input role" id="customRadio5" type="radio" value="2"><label class="custom-control-label" for="customRadio5" style="margin-top:5px !important;">Administrator</label></div><div class="custom-control custom-radio mb-3"><input name="custom-radio-2" class="custom-control-input role" id="customRadio6" type="radio" value="3" checked><label class="custom-control-label" for="customRadio6" style="margin-top:5px !important;">User</label></div></div></div><div class="row"><div class="col-lg-12"><button type="button" class="btn btn-facebook my-4" style="float:right; margin-right: 20px;" id="addUserBtn">Add new user</button></div></div>`;

    $("#insertUser").html(content);
}