<?php

include "models/functions.php"; ?>

<!DOCTYPE HTML>
<html>
<head>
    <?php
    !isset($_GET["page"]) ? $page = "home" : $page = $_GET["page"];

    echo appHeadContent($page);

    switch($page){

        case "home" :
            include "head/homeJs.php";
            break;

        case "store" :
            include "head/storeJs.php";
            break;

        case "single" :
            include "head/singleJs.php";
            break;
    } ?>
</head>