<?php

header("Content-type:application/json");

session_start();

require_once "../../../config/connection.php";

$code = 500;

if(!isset($_SESSION["admin"])){
    $code = 405;
    logs(UNAUTHORIZED_ACCESS);
}
else{
    include "functions.php";

    try{

        $products = getAllProducts();

        if(!$products) $code = 500;
        else{
            $code = 200;
            echo json_encode($products);
        }
    }
    catch(PDOException $exception){
        $code = 500;
        echo json_encode(["error" => $exception -> getMessage()]);
    }
}
http_response_code($code);