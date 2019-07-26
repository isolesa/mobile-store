<?php

use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception;

session_start();

require_once "../../../config/connection.php";

if($_SERVER["REQUEST_METHOD"] !== "POST" || !isset($_POST["register"])){

    logs(UNAUTHORIZED_ACCESS);
    http_response_code(400);
    header("Location:".BASE_URL."/?page=unauthorized&e=register");
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

    if($password != $repeatPassword)
        $errors[] = "Passwords don't match!";

    if(count($errors) > 0){
        foreach($errors as $error)
            echo $error."\n";
        http_response_code(422);
    }
    else{

        require_once "functions.php";

        // Kreiranje podrazumevanih vrednosti za određene kolone u bazi
        $securityToken = createToken(32);
        $confirmationToken = createToken(32);
        $dateOfRegistration = date("Y-m-d H:i:s");
        $active = 0;
        $role = 3;

        try{
            // insertNewUser vraća true ili false u zavisnosti da li je korisnik unet u bazu
            $isInserted = insertNewUser($firstName, $lastName, $username, $email, $password, $securityToken, $confirmationToken, $dateOfRegistration, $active, $role);

            if(!$isInserted){
                http_response_code(500);
                echo "Status: ".$code."\nUser is not registered.";
            }
            else{
                require ABSOLUTE_PATH."/models/app/mail/Exception.php";
                require ABSOLUTE_PATH."/models/app/mail/PHPMailer.php";
                require ABSOLUTE_PATH."/models/app/mail/SMTP.php";

                $mail = new PHPMailer;
                $mail -> isSMTP();
                $mail -> SMTPDebug = 0;
                $mail -> Host = "smtp.gmail.com";
                $mail -> Port = 587;
                $mail -> SMTPSecure = "tls";
                $mail -> SMTPAuth = true;
                $mail -> Username = "";
                $mail -> Password = "";
                $mail -> setFrom("", "Igor Solesa");
                $mail -> addAddress($email, $firstName." ".$lastName);
                $mail -> isHTML(true);
                $mail -> Subject = "Mobile Store Activation";
                $mail -> msgHTML("<html><head><style>h4{font-size: 16px;}#logo{max-height:5vh;background: #94CB32;text-align: center;}#first,#third,#fourth{width:100%;max-height:20vh;margin:10px auto;}.paragraph{color: darkgrey;font-size:13px;}input{padding:15px 60px;border:none;background:#94CB32;color:white;font-size:15px;cursor: pointer;}</style></head><body><div id=\"logo\"><img src=\"".BASE_URL."/assets/app/images/logo.png\"alt=\"logo\"></div><div id=\"first\"><p class=\"paragraph\"><h4>Postovani/a,<br><br>Kliknite na link kako biste aktivirali svoj nalog.</h4></p></div><div id=\"third\"><p class=\"paragraph\"><br><br><h4><a href=\"".BASE_URL."/?page=activation&token=".$confirmationToken."\">".BASE_URL."/?page=activation&token=".$confirmationToken."</a></h4></p></div><div id=\"fourth\"><p class=\"paragraph\"><h4>S postovanjem, Igor Solesa.<br><br>Mobile Store Srbija</h4></p></div></body></html>");
                $mail -> AltBody = "Postovani/a, Da biste aktivirali svoj nalog pratite link ispod:

                ".BASE_URL."/?page=activation&token=".$confirmationToken."

                S postovanjem, Igor Solesa.

                Mobile Store Srbija;";

                if(!$mail -> send())
                    echo "Mailer Error: ".$mail -> ErrorInfo;
                else{
                    http_response_code(200);
                    header("Location: ".BASE_URL."/?page=activation&message=sent");
                }
            }
        }
        catch(PDOException $exception){

            http_response_code(500);
            echo "Status: ".$code."\nError: ".$exception -> getMessage();
        }
    }
}