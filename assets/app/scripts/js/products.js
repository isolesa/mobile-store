$(document).ready(function(){

    let dataObject = new Object();
    let productsPerPage = 8;
    dataObject.productsPerPage = productsPerPage;

    // Sortiranje

    $(document).on("change", "#sortProducts", function(){

        let operation = "sorting";
        let sortType = $(this).val();
        let brandId = $("button[data-active='1']").attr("data-id");
        let page = $(".disabled > button").val();

        insertProperty(dataObject, operation, sortType, brandId, page);
        ajaxRequest(dataObject);
    });

    // Filtriranje

    $(document).on("click", ".brandName", function(){

        let operation = "filtering";
        let brandId = $(this).attr("data-id");
        let sortType = $("#sortProducts").val();
        let page = $(".disabled > button").val();

        insertProperty(dataObject, operation, sortType, brandId, page);
        ajaxRequest(dataObject);
    });

    // Paginacija

    $(document).on("click", ".page-link", function(){

        let operation = "pagination";
        let page = $(this).val();
        let sortType = $("#sortProducts").val();
        let brandId = $("button[data-active='1']").attr("data-id");

        insertProperty(dataObject, operation, sortType, brandId, page);
        ajaxRequest(dataObject);
    });

    // Rejting

    $(document).on("click", ".rating", function(){

        let rating = $(this).attr("data-id");
        let userId = $("#hidden-one").val();
        let productId = $("#hidden-two").val();
        let data = {
            rating:rating,
            userId:userId,
            productId:productId
        };
        sendRating(data);
    });

});

function ajaxRequest(data){

    $.ajax({
        url:"models/app/products/products.php",
        method:"POST",
        dataType:"json",
        data:data,
        success:function(data){
            printNewSetOfProducts(data[0]);
            changeBrandDataActive(data[1]);
            printNewSetOfPageItems(data[1]);
            },
        error:function(xhr, status, error){
            console.log(status + ': ' + error);
        }
    });
}

// Pomoćne funkcije

function insertProperty(dataObject, operation, sortType, brand, page){

    dataObject.operation = operation;
    dataObject.sort = sortType;
    brand !== undefined ? dataObject.brand = brand : dataObject.brand = "0";
    dataObject.page = page;
}

function printNewSetOfProducts(products){

    let content = "";

    for(let product of products)

        content += `<li data-id="${product.productId}" class="itemsLi"><img src="` + BASE_URL + `/assets/app/images/phones/profile/${product.source}" class="items" alt="${product.productName}"/><br clear="all"/><div><a href="` + BASE_URL + `?page=single&id=${product.productId}">${product.brandName} ${product.productName}</a></div><div>${product.price}&euro;</div>`;

    $(".myProducts").html(content);
}

function changeBrandDataActive(otherData){
    $(".brandName").attr("data-active","0");
    $(".brandName[data-id=\"" + otherData.brandId + "\"]").attr("data-active","1");
}

function printNewSetOfPageItems(otherData){

    let content = "";
    if(Number(otherData.numberOfPages) === 0) otherData.numberOfPages = 1;

    for(let i = 1; i <= otherData.numberOfPages; i++){

        if(i === Number(otherData.page))

            content += `<li class="page-item disabled"><button class="page-link" href="#" tabindex="-1" style="width:auto;" value="${i}">${i}</button></li>`;

        else
            content += `<li class="page-item"><button class="page-link" style="width:auto;" value="${i}">${i}</button></li>`;
    }

    $(".pagination").html(content);
}

function sendRating(data){

    $.ajax({
        url:"models/app/products/ratings.php",
        method:"POST",
        dataType:"json",
        data:data,
        success:function(data){
            printRatings(data);
            ratings(data);
            },
        error:function(xhr, status, error){
            console.log(status + ': ' + error);
        }
    });
}

function printRatings(data){

    let content = `<h6>Rate this product!</h6>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`;

    for(let i = 1; i < 6; i++){

        if(i === parseInt(data.rating))

            content += `<button type="button" class="btn btn-success btn-sm rating" data-id="${i}">${i}</button>`;

        else
            content += `<button type="button" class="btn btn-outline-success btn-sm rating" data-id="${i}">${i}</button>`;
    }

    $(".ratingGroup").html(content);
}

function ratings(data){

    let content = ``;
    if(data.numberOfVotes === 1) content += `Rating: ${data.averageRating}&nbsp;&nbsp;&nbsp;(One user rated this product)`;

    else content += `Rating: ${data.averageRating}&nbsp;&nbsp;&nbsp;(${data.numberOfVotes} users rated this product)`;

    $(".prating").html(content);
}