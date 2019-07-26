<?php

session_start();

require_once "../../../config/connection.php";

$code = 500;

if(!isset($_SESSION["admin"]) || $_SERVER["REQUEST_METHOD"] !== "POST"){

    $code = 405;
    logs(UNAUTHORIZED_ACCESS);
}
else{
    $modelReg = "/^[A-z0-9_-]{3,60}(\s[A-z0-9_-]{3,60})*$/";
    $priceReg = "/^[0-9]{1,5}$/";
    $brandId = trim($_POST["brandId"]);
    $model = trim($_POST["model"]);
    $price = trim($_POST["price"]);
    $errors = [];

    if(!preg_match($modelReg, $model))
        $errors[] = "First name is not ok!";

    if(!preg_match($priceReg, $price))
        $errors[] = "Last name is not ok!";

    if(count($errors) > 0){
        foreach($errors as $error)
            echo $error."\n";
        $code = 422;
    }
    else{

        include "functions.php";

        $bigImageName = "default.jpg";
        $bigImageName = productImage($bigImageName);

        try{
            $isInserted = insertNewProduct($model, $price, $brandId, $bigImageName);

            if($isInserted) $code = 201;
            else{
                $code = 500;
                echo "Status: ".$code."\nProduct is not inserted.";
            }
        }
        catch(PDOException $exception){
            $code = 500;
            echo "Status: ".$code."\n".$exception -> getMessage();
        }
    }
}
http_response_code($code);