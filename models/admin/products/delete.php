<?php

session_start();

require_once "../../../config/connection.php";

$code = 500;

if(!isset($_SESSION["admin"]) || $_SERVER["REQUEST_METHOD"] !== "POST"){

    $code = 405;
    logs(UNAUTHORIZED_ACCESS);
}
else{
    include "functions.php";

    $productId = trim($_POST["productId"]);

    try{
        $isDeleted = deleteProduct($productId);

        if($isDeleted) $code = 204;
        else{
            $code = 500;
            echo "Status: ".$code."\nProduct is not deleted.";
        }
    }
    catch(PDOException $exception){

        $code = 500;
        echo "Status: ".$code."\n".$exception -> getMessage();
    }
}
http_response_code($code);