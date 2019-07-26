<?php

header("Content-type:application/json");

session_start();

require_once "../../../config/connection.php";

$code = 500;

if(!isset($_SESSION["admin"]) || $_SERVER["REQUEST_METHOD"] !== "POST"){

    $code = 405;
    logs(UNAUTHORIZED_ACCESS);
    http_response_code($code);
    header("Location:".BASE_URL."/?access=admin&page=unauthorized&e=brands");
}
else{

    require_once "functions.php";

    $brandId = $_POST["brandId"];

    try{
        $brand = getBrand($brandId);

        if(!$brand) $code = 500;
        else $code = 200;

        echo json_encode($brand);
    }
    catch(PDOException $exception){

        $code = 500;
        echo json_encode(["error" => $exception -> getMessage()]);
    }
    http_response_code($code);
}