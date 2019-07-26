<?php

session_start();

require_once "../../../config/connection.php";

$code = 500;

if(!isset($_SESSION["admin"]) || $_SERVER["REQUEST_METHOD"] !== "POST"){

    $code = 405;
    logs(UNAUTHORIZED_ACCESS);
}
else{
    $brandReg = "/^[A-z0-9_-]{3,60}(\s[A-z0-9_-]{3,60})*$/";
    $brandName = trim($_POST["brandName"]);
    $brandId = trim($_POST["brandId"]);
    $errors = [];

    if(!preg_match($brandReg, $brandName))
        $errors[] = "Brand name is not ok!";

    if(count($errors) > 0){

        foreach($errors as $error)
            echo $error."\n";

        $code = 422;
    }
    else{
        include "functions.php";

        try{
            $isUpdated = updateBrand($brandName, $brandId);

            if($isUpdated) $code = 201;
            else{
                $code = 500;
                echo "Status: ".$code."\nBrand is not updated.";
            }
        }
        catch(PDOException $exception){

            $code = 500;
            echo "Status: ".$code."\n".$exception -> getMessage();
        }
    }
}
http_response_code($code);