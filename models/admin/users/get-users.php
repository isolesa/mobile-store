<?php

header("Content-type:application/json");

session_start();

require_once "../../../config/connection.php";

$code = 500;

if(!isset($_SESSION["admin"])){

    $code = 400;
    logs(UNAUTHORIZED_ACCESS);
}
else{
    include "functions.php";

    try{
        $users = getUsers();

        if(!$users) $code = 500;
        else{
            $code = 200;
            echo json_encode($users);
        }
    }
    catch(PDOException $exception){
        $code = 500;
        echo json_encode(["error" => $exception -> getMessage()]);
    }
}
http_response_code($code);