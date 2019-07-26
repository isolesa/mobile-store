<?php

header("Content-Type: application/json");

require_once "../../../config/connection.php";

$code = 500;

if($_SERVER["REQUEST_METHOD"] !== "POST"){

    $code = 405;
    logs(UNAUTHORIZED_ACCESS);
}
else{
    include "functions.php";

    $operation = $_POST["operation"];
    $sortType = $_POST["sort"];
    $brandId = $_POST["brand"];
    $page = $_POST["page"];
    $productsPerPage = $_POST["productsPerPage"];

    try{
        // Definišem novu vrednost za broj stranica ako mi je stigao zahtev za filtriranjem
        // Zavisi od broja proizvoda selektovanog brenda

        $numberOfPages = getNumberOfPages($productsPerPage, $brandId);

        // Ako mi je stigao zahtev za sortiranjem ili filtriranjem, paginaciju vraćam na prvu stranicu
        // Ako je paginacija u pitanju, inicijalna vrednost iz request-a za stranicu ostaje

        $newPage = getPageByOperation($operation,$page);

        // Selektujem novu garnituru proizvoda

        $products = getNewSetOfProducts($operation, $sortType, $brandId, $productsPerPage, $page);
        $otherData = (["operation" => $operation, "sortType" => $sortType, "brandId" => $brandId, "page" => $newPage, "productsPerPage" => $productsPerPage, "numberOfPages" => $numberOfPages]);

        // Vraćam selektovane proizvode i podatke kojima ću osvežiti DOM

        $response = ([$products, $otherData]);
        $response ? $code = 200 : $code = 500;

        echo json_encode($response);
    }
    catch(PDOException $e){

        $code = 500;
        echo json_encode(["error" => $e -> getMessage()]);
    }

}
http_response_code($code);