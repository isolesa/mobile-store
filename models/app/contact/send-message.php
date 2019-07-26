<?php

session_start();

require_once "../../../config/connection.php";

$code = 500;

if($_SERVER["REQUEST_METHOD"] !== "POST"){

    $code = 405;
    logs(UNAUTHORIZED_ACCESS);
}
else{
    $firstLastNameReg = "/^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,15}(\s[A-ZČĆŽŠĐ][a-zčćžšđ]{2,15})*$/";
    $subjectReg = "/^[A-Za-z0-9 .'?!,@$#-_\n\r]{2,200}$/";
    $firstLastName = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $subject = trim($_POST["subject"]);
    $errors = [];

    if(!preg_match($firstLastNameReg, $firstLastName))
        $errors[] = "Name is not ok!";

    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        $errors[] = "Email is not ok!";

    if(!preg_match($subjectReg, $subject))
        $errors[] = "Subject is not ok!";

    if(count($errors) > 0){
//        foreach($errors as $error)
//            echo $error."\n";
        $code = 422;
    }
    else{
        include "functions.php";

        try{
            $insertMessage = insertMessage($firstLastName,$email,$subject);
            if(!$insertMessage) $code = 500;
            else $code = 201;
        }
        catch(PDOException $exception){
            $code = 500;
            echo "Status: ".$code."\nError: ".$exception -> getMessage();
        }
    }
}
http_response_code($code);