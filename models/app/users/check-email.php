<?php

header("Content-type: application/json");

require_once "../../../config/connection.php";

$status = false;
$code = 500;

if(!$_SERVER["REQUEST_METHOD"] === "POST"){

    $code = 405;
    logs(UNAUTHORIZED_ACCESS);
    http_response_code($code);
    header("Location:".BASE_URL."/?page=unauthorized");
}
else{
    include "functions.php";

    $email = $_POST["email"];

    try{
        // checkEmail vraća true ili false u zavisnosti od toga da li postoji email

        if(checkEmail($email)) $status = true;

        $code = 200;

        // Vraćam "status" true ako postoji ili false u suprotnom
        echo json_encode(["status" => $status]);
    }
    catch(PDOException $exception){

        $code = 500;
        echo json_encode(["response" => $code, "error" => $exception -> getMessage()]);
    }
    http_response_code($code);
}