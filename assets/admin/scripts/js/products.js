$(document).ready(function(){

    $(document).on("click",".update",function(){

        let productId = $(this).attr("data-id");

        $.ajax({
            url:"models/admin/products/get-product.php",
            method:"POST",
            data:{productId:productId},
            success:function(data){
                modalContentView(data);
                },
            error:function(xhr, status, error){
                console.log(status + ': ' + error);
            }
        });
    });

    $(document).on("click","#addProductBtn",addProduct);
    $(document).on("click","#updateProductBtn",updateProduct);
    $(document).on("click","#deleteProductBtn",deleteProduct);
});

function modalContentView(product){

    let content = `<div class="row" style="padding-top:10px;"><div class="text-muted text-center mt-2 mb-3"><h4>${product.brandName} ${product.productName}</h4></div></div><div class="row" style="padding:0 20px 0 20px; margin-top:10px;"><div class="col-lg-6"><label>Brand:</label><br><div id="brandsDdl"></div>`;

    getBrand(product.brandId, callbackU);

    content += `<br><label>Price (&euro;):</label><input type="text" class="form-control form-control-alternative price" id="exampleFormControlInput1" id="price" placeholder="${product.price}"></div><div class="col-lg-6 ml-auto"><label>Model:</label><input type="text" class="form-control form-control-alternative model" id="exampleFormControlInput1" id="model" placeholder="${product.productName}"><label>Product photo:</label><br><img src="` + BASE_URL + `/assets/app/images/phones/profile/${product.source}" alt="${product.producName}" class="img-thumbnail profileImg"><br><button type="button" onclick="document.getElementById('profilePhoto').click()" class="btn btn-facebook">Change product photo</button><span id="profilePhotoValue"></span><input type="file" name="slika" id="profilePhoto" style="display:none;" onchange="document.getElementById('profilePhotoValue').innerHTML=this.value;"/></div></div><div class="row"><div class="col-lg-12"><button type="button" class="btn btn-facebook my-4" style="float:right; margin-right: 20px;" id="updateProductBtn" data-id="${product.productId}">Change</button></div></div>`;

    $("#updateModal").html(content);
}

function getBrand(brandId, callback){

    $.ajax({
        url:"models/admin/brands/get-brands.php",
        method:"POST",
        dataType:"json",
        success:function(brands){
            let content = `<select class="custom-select mr-sm-12 brands" id="inlineFormCustomSelect">`;

            for(brand of brands){
                if (brand.brandId === brandId)
                    content += `<option value="${brand.brandId}" data-id="${brand.brandId}" selected>${brand.brandName}</option>`;
                else
                    content += `<option value="${brand.brandId}" data-id="${brand.brandId}">${brand.brandName}</option>`;
            }

            content += `</select>`;

            callback(content);
            },
        error:function(xhr, status, error){
            console.log(status + ': ' + error);
        }
    });
}

function callbackU(content){
    $("#brandsDdl").html(content);
}

function callbackI(content){
    $("#brandsDdlI").html(content);
}



function addProduct(){

    let modelReg = /^[A-z0-9_-]{3,60}(\s[A-z0-9_-]{3,60})*$/;
    let priceReg = /^[0-9]{1,5}$/;
    let brandId = $(".brands").val();
    let model = $(".model").val();
    let price = $(".price").val();
    let formData = new FormData();
    let image = $("#profilePhoto")[0].files[0];

    formData.append("file",image);
    formData.append("brandId",brandId);
    formData.append("model",model);
    formData.append("price",price);

    let url = "models/admin/products/insert.php";
    let errors = [];

    if(!model.match(modelReg)){
        errors.push("Model is not ok!");
        $(".model").addClass("redBorder");
    }
    else $(".model").removeClass("redBorder");

    if(!price.match(priceReg)){
        errors.push("Price is not ok!");
        $(".price").addClass("redBorder");
    }
    else $(".price").removeClass("redBorder");

    if(errors.length > 0){
        console.log(errors);
    }
    else sendProductData(formData, url);
}

function sendProductData(data, url){
    $.ajax({
        url:url,
        method:"POST",
        cache: false,
        contentType:false,
        processData:false,
        data:data,
        success:function(response, statusText, jqXHR){
            if(jqXHR.status === 201 || jqXHR.status === 204) getProducts();
            },
        error:function(jqXHR, status, error){
            console.log(jqXHR.status);
        }
    });
}

function getProducts(){

    $.ajax({
        url:"models/admin/products/get-products.php",
        method:"GET",
        dataType:"json",
        success:function(data){
            $("#modal-insert").modal("hide");
            $("#modal-update").modal("hide");
            printProducts(data);
            clearModalInsert();
            },
        error:function(xhr, status, error){
            console.log(status + ': ' + error);
        }
    });
}

function printProducts(products){

    let content = "";

    for(let product of products)
        content += `<tr><td>${product.brandName}</td><td>${product.productName}</td><td>${product.price}</td><td>${product.published}</td><td class="text-right"><div class="dropdown"><a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a><div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow"><button class="dropdown-item update" data-id="${product.productId}" data-toggle="modal" data-target="#modal-update">Update</button><button class="dropdown-item" id="deleteProductBtn" href="#" data-id="${product.productId}">Delete</button></div></div></td></tr>`;

    $("#productTbody").html(content);
}

function clearModalInsert(){

    let content = `<div class="row" style="padding:0 20px 0 20px; margin-top:10px;"><div class="col-lg-6"><label>Brand:</label><br><div id="brandsDdlI"></div>`;

    getBrand(1, callbackI);

    content += `<br><label>Price:</label><input type="text" class="form-control form-control-alternative price exampleFormControlInput1" placeholder="Price"></div><div class="col-lg-6 ml-auto"><label>Model:</label><input type="text" class="form-control form-control-alternative model exampleFormControlInput1" placeholder="Model"><label>Product photo:</label><br><button type="button" onclick="document.getElementById('profilePhoto').click()" class="btn btn-facebook">Add product photo</button><span id="profilePhotoValue"></span><input type="file" name="slika" id="profilePhoto" style="display:none;" onchange="document.getElementById('profilePhotoValue').innerHTML=this.value;"/></div></div><div class="row"><div class="col-lg-12"><button type="button" class="btn btn-facebook my-4" id="addProductBtn" style="float:right; margin-right: 20px;">Add new product</button></div></div>`;

    $("#insertProduct").html(content);
}

function updateProduct(){

    let modelReg = /^[A-z0-9_-]{3,60}(\s[A-z0-9_-]{3,60})*$/;
    let priceReg = /^[0-9]{1,5}$/;
    let brandId = $(".brands").val();
    let model = $(".model").val();
    let price = $(".price").val();
    let productId = $(this).attr("data-id");
    let formData = new FormData();
    let image = $("#profilePhoto")[0].files[0];

    formData.append("file",image);
    formData.append("brandId",brandId);
    formData.append("model",model);
    formData.append("price",price);
    formData.append("productId",productId);

    let url = "models/admin/products/update.php";
    let errors = [];

    if(!model.match(modelReg)){
        errors.push("Model is not ok!");
        $(".model").addClass("redBorder");
    }
    else $(".model").removeClass("redBorder");

    if(!price.match(priceReg)){
        errors.push("Price is not ok!");
        $(".price").addClass("redBorder");
    }
    else $(".price").removeClass("redBorder");

    if(errors.length > 0){
        console.log(errors);
    }
    else sendProductData(formData, url);
}

function deleteProduct(){

    let productId = $(this).attr("data-id");
    let formData = new FormData();
    formData.append("productId",productId);
    let url = "models/admin/products/delete.php";

    sendProductData(formData, url);
}