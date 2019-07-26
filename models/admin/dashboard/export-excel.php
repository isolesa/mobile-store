<?php

require_once "../../../config/connection.php";

$code = 500;

if($_SERVER["REQUEST_METHOD"] !== "POST"){

    $code = 405;
    logs(UNAUTHORIZED_ACCESS);
}
else{
    require_once "functions.php";

    $urls = $_POST["urls"];
    $visits = $_POST["visits"];

    try{
        $insert = insertExcel($urls,$visits);
        $code = 200;
    }
    catch(PDOException $exception){
        $code = 500;
        echo "Status: ".$code."\n".$exception -> getMessage();
    }
}
http_response_code($code);