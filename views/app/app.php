<?php

// Proveravam da li se pristupa login i register stranici ako je korisnik već ulogovan

if(isset($_SESSION["user"]) && isset($_GET["page"]) && ($_GET["page"] === "register" || $_GET["page"] === "login"))
    unset($_GET["page"]);

include "fixed/head.php";
include "fixed/header.php";

if(!isset($_GET["page"])){
    include "pages/home.php";
}
else switch($_GET["page"]) {

    case "about" :
        include "pages/about.php";
        break;

    case "store" :
        include "pages/store.php";
        break;

    case "single" :
        include "pages/single.php";
        break;

    case "contact" :
        include "pages/contact.php";
        break;

    case "register" :
        include "pages/register.php";
        break;

    case "login" :
        include "pages/login.php";
        break;

    case "unauthorized" :
        include "pages/unauthorized.php";
        break;

    case "activation" :
        include "pages/activation.php";
        break;

    case "profile" :
        include "pages/profile.php";
        break;

    default :
        include "pages/home.php";
        break;
}

include "fixed/footer.php";