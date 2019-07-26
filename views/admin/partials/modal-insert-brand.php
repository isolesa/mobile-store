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
    <div class="text-muted text-center mt-2 mb-3"><h4>New brand</h4></div>
</div>
<form method="POST" id="insertBrand">
    <div class="row" style="padding:0 20px 0 20px; margin-top:10px;">
        <div class="col-lg-6">
            <label>Brand name:</label>
            <input type="text" class="form-control form-control-alternative brandName exampleFormControlInput1" placeholder="Brand name">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <button type="button" class="btn btn-facebook my-4" style="float:right; margin-right: 20px;" id="addBrandBtn">Add new brand</button>
        </div>
    </div>
</form>