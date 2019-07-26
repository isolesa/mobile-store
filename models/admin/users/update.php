<?php

session_start();

require_once "../../../config/connection.php";

$code = 500;

if(!isset($_SESSION["admin"]) || $_SERVER["REQUEST_METHOD"] !== "POST"){

    $code = 405;
    logs(UNAUTHORIZED_ACCESS);
}
else{
    $firstLastNameReg = "/^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,15}(\s[A-ZČĆŽŠĐ][a-zčćžšđ]{2,15})*$/";
    $userId = trim($_POST["userId"]);
    $firstName = trim($_POST["firstName"]);
    $lastName = trim($_POST["lastName"]);
    $dateOfBirth = trim($_POST["dateOfBirth"]);
    $role = (int)trim($_POST["role"]);
    $errors = [];

    if(!preg_match($firstLastNameReg, $firstName))
        $errors[] = "First name is not ok!";

    if(!preg_match($firstLastNameReg, $lastName))
        $errors[] = "Last name is not ok!";

    if(count($errors) > 0){
        foreach($errors as $error)
            echo $error."\n";
        $code = 422;
    }
    else{
        include "functions.php";
        include "../../app/users/functions.php";

        $smallImageName = "defaultSmall.jpg";
        $bigImageName = "defaultBig.jpg";

        list($bigImageName, $smallImageName) = image($bigImageName, $smallImageName);

        try{
            $isUpdated = updateUser($userId,$firstName,$lastName,$dateOfBirth,$smallImageName,$bigImageName,$role);

            if($isUpdated)
                $code = 204;
            else{
                $code = 500;
                echo "Status: ".$code."\nUser is not updated.";
            }
        }
        catch(PDOException $exception){
            $code = 500;
            echo "Status: ".$code."\n".$exception -> getMessage();
        }
    }
}
http_response_code($code);