<?php

if(!isset($_SESSION["user"]) && !isset($_SESSION["admin"])) {
    include "fixed/forbidden.php";
    logs(UNAUTHORIZED_ACCESS);
}
else{
    include "fixed/head.php";
    include "fixed/side-nav.php";
    include "fixed/top-nav.php";

    if(!isset($_GET["page"]) || (isset($_GET["page"]) && $_GET["page"] !== "author"))
        include "fixed/header.php";

    if(!isset($_GET["page"]))
        include "pages/dashboard.php";
    else switch($_GET["page"]){

        case "dashboard" :
            include "pages/dashboard.php";
            break;
        case "users" :
            include "pages/users.php";
            break;
        case "products" :
            include "pages/products.php";
            break;
        case "brands" :
            include "pages/brands.php";
            break;
        case "author" :
            include "pages/author.php";
            break;
        case "inbox" :
            include "pages/messages.php";
            break;
        case "unauthorized" :
            include "pages/unauthorized.php";
            break;
        default  :
            include "pages/dashboard.php";
            break;
    }

    include "fixed/scripts.php";
}