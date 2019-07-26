<?php

session_start();

require_once "../../../config/connection.php";

if($_SERVER["REQUEST_METHOD"] !== "POST" || !isset($_POST["login"])){

    logs(UNAUTHORIZED_ACCESS);
    http_response_code(405);
    header("Location:".BASE_URL."/?page=unauthorized&e=login");
}
else{
    $emailReg = "/^[a-z]+(\.[a-z]+)+(\.[1-9][0-9]{0,3}\.(0[0-9]|1[0-8]))?\@ict\.edu\.rs$/";
    $passwordReg = "/^(?=.*[A-ZŠĐČĆa-zžšđčć])(?=.*\d)(?=.*[@$!%*#?&])[A-ZŽŠĐČĆa-zžšđčć\d@$!%*#?&]{8,120}$/";
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $errors = [];

    if(!preg_match($emailReg, $email))
        $errors[] = "Email is not ok!";

    if(!preg_match($passwordReg, $password))
        $errors[] = "Password is not ok!";

    if(count($errors) > 0){
        foreach($errors as $error)
            echo $error."\n";
        http_response_code(422);
    }
    else{
        include "functions.php";

        try{
            // checkUser vraća objekat korisnika ako postoji ili false u suprotnom
            $user = checkUser($email,$password);

            if(!$user) header("Location:".BASE_URL."/?page=login&email=".$email."&e=wrong-credentials");
            else{
                // Postavljanje sesija za user-a
                $_SESSION["user"] = $user;
                setOnlineStatus($user -> userId);
                if($user -> roleId === "2") $_SESSION["admin"] = $user;
                if($user -> roleId === "1"){
                    $_SESSION["admin"] = $user;
                    $_SESSION["superuser"] = $user;
                }
                http_response_code(204);
                header("Location: ".BASE_URL);
            }
        }
        catch(PDOException $exception){

            http_response_code(500);
            echo "Status: ".$code."\nError: ".$exception -> getMessage();
        }
    }
}
