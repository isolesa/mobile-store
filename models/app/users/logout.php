<?php

session_start();

require_once "../../../config/connection.php";

if(!isset($_SESSION["user"])){

    logs(UNAUTHORIZED_ACCESS);
    http_response_code(400);
    header("Location:".BASE_URL."/?page=unauthorized");
}
else{
    include "functions.php";

    unsetOnlineStatus($_SESSION["user"] -> userId);
    if(isset($_SESSION["superuser"])) unset($_SESSION["superuser"]);
    if(isset($_SESSION["admin"])) unset($_SESSION["admin"]);
    unset($_SESSION["user"]);

    header("Location: ".BASE_URL);
}