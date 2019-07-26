<style>
    .col-lg-6 input:nth-child(0){
        margin-top: 60px;
    }
    .text-center{
        width:100%;
    }
    label{
        margin-top: 30px;
    }
    .redBorder{
        border:1px solid red;
    }
</style>
<div class="row" style="padding-top:10px;">
    <div class="text-muted text-center mt-2 mb-3"><h4>New product</h4></div>
</div>
<form enctype="multipart/form-data" method="POST" id="insertProduct">
    <div class="row" style="padding:0 20px 0 20px; margin-top:10px;">
        <div class="col-lg-6">
            <?php
            include "models/admin/brands/functions.php";
            $brands = getAllBrands();
            ?>
            <label>Brand:</label><br>
            <select class="custom-select mr-sm-12 brands" id="inlineFormCustomSelect">
                <?php
                foreach($brands as $brand) : ?>
                    <option value="<?= $brand -> brandId ?>"><?= $brand -> brandName ?></option>
                <?php endforeach; ?>
            </select><br>
            <label>Price:</label>
            <input type="text" class="form-control form-control-alternative price exampleFormControlInput1" placeholder="Price">
        </div>
        <div class="col-lg-6 ml-auto">
            <label>Model:</label>
            <input type="text" class="form-control form-control-alternative model exampleFormControlInput1" placeholder="Model">
            <label>Product photo:</label><br>
            <button type="button" onclick="document.getElementById('profilePhoto').click()" class="btn btn-facebook">Add product photo</button>
            <span id="profilePhotoValue"></span>
            <input type="file" name="slika" id="profilePhoto" style="display:none;" onchange="document.getElementById('profilePhotoValue').innerHTML=this.value;"/>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <button type="button" class="btn btn-facebook my-4" id="addProductBtn" style="float:right; margin-right: 20px;">Add new product</button>
        </div>
    </div>
</form>