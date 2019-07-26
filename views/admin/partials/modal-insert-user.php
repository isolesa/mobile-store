<style>
    .col-lg-6 input:nth-child(0){
        margin-top: 10px;
    }
    .text-center{
        width:100%;
    }
    label{
        margin-top: 15px;
    }
    .redBorder{
        border:1px solid red;
    }
</style>
<div class="row" style="padding-top:10px;">
    <div class="text-muted text-center mt-2 mb-3"><h4>New user</h4></div>
</div>
<form enctype="multipart/form-data" method="POST" id="insertUser">
    <div class="row" style="padding:0 20px 0 20px; margin-top:10px;">
        <div class="col-lg-6">
            <label>First name:</label>
            <input type="text" class="form-control form-control-alternative firstName exampleFormControlInput1" placeholder="First name">
            <label>E-mail:</label>
            <input type="text" class="form-control form-control-alternative email exampleFormControlInput1" placeholder="E-mail">
            <input type="hidden" class="form-control isExists" value=""/>
            <label for="example-date-input" class="col-6 col-form-label">Date Of Birth:</label>
            <div class="col-10">
                <input class="form-control dateOfBirth" type="date" value="1993-08-19" id="example-date-input">
            </div>
            <label>Profile photo:</label><br>
            <button type="button" onclick="document.getElementById('profilePhoto').click()" class="btn btn-facebook">Add profile photo</button>
            <span id="profilePhotoValue"></span>
            <input type="file" name="slika" id="profilePhoto" style="display:none;" onchange="document.getElementById('profilePhotoValue').innerHTML=this.value;"/>
        </div>
        <div class="col-lg-6 ml-auto">
            <label>Last name:</label>
            <input type="text" class="form-control form-control-alternative lastName exampleFormControlInput1" placeholder="Last name">
            <label>Username:</label>
            <input type="text" class="form-control form-control-alternative username exampleFormControlInput1" placeholder="Username">
            <input type="hidden" class="form-control isExists" value=""/>
            <label>Password:</label>
            <input type="password" class="form-control form-control-alternative password exampleFormControlInput1" placeholder="Password">
            <label>Repeat password:</label>
            <input type="password" class="form-control form-control-alternative repeatPassword exampleFormControlInput1" placeholder="Repeat password">
            <label>Role:</label><br>
            <div class="custom-control custom-radio mb-3">
                <input name="custom-radio-2" class="custom-control-input role" id="customRadio5" type="radio" value="2">
                <label class="custom-control-label" for="customRadio5" style="margin-top:5px !important;">Administrator</label>
            </div>
            <div class="custom-control custom-radio mb-3">
                <input name="custom-radio-2" class="custom-control-input role" id="customRadio6" type="radio" value="3" checked>
                <label class="custom-control-label" for="customRadio6" style="margin-top:5px !important;">User</label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <button type="button" class="btn btn-facebook my-4" style="float:right; margin-right: 20px;" id="addUserBtn">Add new user</button>
        </div>
    </div>
</form>