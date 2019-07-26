$(document).ready(function(){

    $(document).on("click",".update",function(){
        let brandId = $(this).attr("data-id");

        $.ajax({
            url: "models/admin/brands/get-brand.php",
            method: "POST",
            data:{brandId: brandId},
            success:function(data){
                modalContentView(data);
                },
            error:function(xhr, status, error){
                console.log(status + ': ' + error);
            }
        });
    });

    $(document).on("click","#addBrandBtn",addBrand);
    $(document).on("click","#updateBrandBtn",updateBrand);
    $(document).on("click","#deleteBrandBtn",deleteBrand);
});

function modalContentView(brand){

    let content = `<div class="row" style="padding-top:10px;"><div class="text-muted text-center mt-2 mb-3"><h4>${brand.brandName}</h4></div></div><div class="row" style="padding:0 20px 0 20px; margin-top:10px;"><div class="col-lg-6"><label>Id:</label><input type="text" class="form-control form-control-alternative brandIdUpdate exampleFormControlInput1" value="${brand.brandId}" disabled></div><div class="col-lg-6"><label>Brand name:</label><input type="text" class="form-control form-control-alternative brandName exampleFormControlInput1" value="${brand.brandName}"></div></div><div class="row"><div class="col-lg-12"><button type="button" class="btn btn-facebook my-4" style="float:right; margin-right: 20px;" id="updateBrandBtn" data-id="${brand.brandId}">Change</button></div></div>`;

    $("#updateModal").html(content);
}

function addBrand(){

    let brandReg = /^[A-z0-9_-]{3,60}(\s[A-z0-9_-]{3,60})*$/;
    let brandName = $(".brandName").val();
    let data = new Object();
    data.brandName = brandName;
    let url = "models/admin/brands/insert.php";
    let errors = [];

    if(!brandName.match(brandReg)){
        errors.push("Brand is not ok!");
        $(".brandName").addClass("redBorder");
    }
    else $(".brandName").removeClass("redBorder");

    if(errors.length > 0){
        console.log(errors);
    }
    else sendBrandData(data, url);
}

function updateBrand(){

    let brandReg = /^[A-z0-9_-]{3,60}(\s[A-z0-9_-]{3,60})*$/;
    let brandName = $(".brandName").val();
    let brandId = $(this).attr("data-id");
    let data = new Object();
    data.brandName = brandName;
    data.brandId = brandId;
    let url = "models/admin/brands/update.php";
    let errors = [];

    if(!brandName.match(brandReg)){
        errors.push("Brand is not ok!");
        $(".brandName").addClass("redBorder");
    }
    else $(".brandName").removeClass("redBorder");

    if(errors.length > 0){
        console.log(errors);
    }
    else sendBrandData(data, url);
}

function deleteBrand(){

    let brandId = $(this).attr("data-id");
    let data = new Object();
    data.brandId  = brandId;
    let url = "models/admin/brands/delete.php";

    sendBrandData(data, url);
}

function sendBrandData(data, url){

    $.ajax({
        url:url,
        method:"POST",
        data:data,
        success:function(response, statusText, jqXHR){
            console.log(jqXHR.status);
            if(jqXHR.status === 201 || jqXHR.status === 204) getBrands();
            },
        error:function(jqXHR, status, error){
            console.log(jqXHR.status);
        }
    });
}

function getBrands(){

    $.ajax({
        url:"models/admin/brands/get-brands.php",
        method:"GET",
        dataType:"json",
        success:function(data){
            $("#modal-insert").modal("hide");
            $("#modal-update").modal("hide");
            printBrands(data);
            clearModalInsert();
            },
        error:function(xhr, status, error){
            console.log(status + ': ' + error);
        }
    });
}

function printBrands(brands){

    let content = "";

    for(let brand of brands)

        content += `<tr><td>${brand.brandId}</td><td>${brand.brandName}</td><td class="text-right"><div class="dropdown"><a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a><div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow"><button class="dropdown-item update" data-id="${brand.brandId}" data-toggle="modal" data-target="#modal-update">Update</button><button class="dropdown-item" id="deleteBrandBtn" href="#" data-id="${brand.brandId}">Delete</button></div></div></td></tr>`;

    $("#brandsTbody").html(content);
}

function clearModalInsert(){

    let content = `<div class="row" style="padding:0 20px 0 20px; margin-top:10px;"><div class="col-lg-6"><label>Brand name:</label><input type="text" class="form-control form-control-alternative brandName exampleFormControlInput1" placeholder="Brand name"></div></div><div class="row"><div class="col-lg-12"><button type="button" class="btn btn-facebook my-4" style="float:right; margin-right: 20px;" id="addBrandBtn">Add new brand</button></div></div>`;

    $("#insertBrand").html(content);
}