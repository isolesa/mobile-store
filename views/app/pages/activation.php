<style>
    .message{
        margin:100px auto;
        width:50%;
        height: auto;
        min-height: 50vh;
        text-align: center;
        color: red;
        font-size: 28px;
    }
    .message a{
        text-align: right;
        text-decoration: none;
        color: blue;
        font-size: 20px;
    }
    .ok{
        color: #94CB32;
    }
</style>
<div class="message">
    <?php
    if(isset($_GET["message"]) && $_GET["message"] === "sent"){
        echo "<h2 class=\"ok\">We sent you an activation email.<br>Check the spam folder.<br>Maybe wait a minute oor five. :)</h2>";
    }
    else{
        if(!isset($_GET["token"])){
            echo "<h2>Something went wrong! Sorry!</h2>";
        }
        else{
            include "models/app/users/functions.php";
            $token = $_GET["token"];
            $checkToken = checkToken($token);
            if($checkToken === 1){
                echo "<h2>Something went wrong! Sorry!</h2>";
            }
            elseif($checkToken === 2){
                echo "<h2>User is already active.</h2>";
            }
            elseif($checkToken === 3){
                echo "<h2>Activation unsuccessful!</h2>";
            }
            else{
                $user = $checkToken;
                echo "<h2 class=\"ok\">Activation successful!</h2>";
                $_SESSION["user"] = $user;

                setOnlineStatus($user -> userId);
            }
        }
    }
    echo "<a href=\"".BASE_URL."\">Back to home</a>";
    ?>
</div>