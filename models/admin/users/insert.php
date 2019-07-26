<?php

session_start();

require_once "../../../config/connection.php";

$code = 500;

if(!isset($_SESSION["admin"]) || $_SERVER["REQUEST_METHOD"] !== "POST"){

    $code = 400;
    logs(UNAUTHORIZED_ACCESS);
}
else{
    $firstLastNameReg = "/^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,15}(\s[A-ZČĆŽŠĐ][a-zčćžšđ]{2,15})*$/";
    $usernameReg = "/^[A-z0-9_-]{5,60}$/";
    $emailReg = "/^[a-z]+(\.[a-z]+)+(\.[1-9][0-9]{0,3}\.(0[0-9]|1[0-8]))?\@ict\.edu\.rs$/";
    $passwordReg = "/^(?=.*[A-ZŠĐČĆa-zžšđčć])(?=.*\d)(?=.*[@$!%*#?&])[A-ZŽŠĐČĆa-zžšđčć\d@$!%*#?&]{8,120}$/";
    $firstName = trim($_POST["firstName"]);
    $lastName = trim($_POST["lastName"]);
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $repeatPassword = trim($_POST["repeatPassword"]);
    $dateOfBirth = trim($_POST["dateOfBirth"]);
    $role = (int)trim($_POST["role"]);
    $errors = [];

    if(!preg_match($firstLastNameReg, $firstName))
        $errors[] = "First name is not ok!";

    if(!preg_match($firstLastNameReg, $lastName))
        $errors[] = "Last name is not ok!";

    if(!preg_match($usernameReg, $username))
        $errors[] = "Username is not ok!";

    if(!preg_match($emailReg, $email))
        $errors[] = "Email is not ok!";

    if(!preg_match($passwordReg, $password))
        $errors[] = "Password is not ok!";

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

        $securityToken = createToken(32);
        $dateOfRegistration = date("Y-m-d H:i:s");
        $active = 1;

        try{
            $isInserted = insertNewUserFromAdmin($firstName, $lastName, $username, $email, $password, $securityToken, $dateOfRegistration, $active, $role, $dateOfBirth, $bigImageName, $smallImageName);

            if($isInserted) $code = 201;
            else{
                $code = 500;
                echo "Status: ".$code."\nUser is not inserted.";
            }
        }
        catch(PDOException $exception){
            $code = 500;
            echo "Status: ".$code."\n".$exception -> getMessage();
        }
    }
}
http_response_code($code);