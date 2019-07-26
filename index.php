<?php

session_start();

require_once "config/connection.php";

if(!isset($_SESSION["admin"]) && isset($_GET["access"]) && $_GET["access"] === "admin"){
    include "views/admin/fixed/forbidden.php";
    logs(UNAUTHORIZED_ACCESS);
}
elseif(isset($_SESSION["admin"]) && (!isset($_GET["access"]) || $_GET["access"] !== "admin"))
    include "views/app/app.php";
elseif(isset($_SESSION["admin"]) && isset($_GET["access"]) && $_GET["access"] === "admin")
    include "views/admin/admin.php";
else include "views/app/app.php";