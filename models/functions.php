<?php

// Dohvatanje linkova iz navigacije i sortiranje po poziciji

function getNavItems(){
    return executeQuery("SELECT itemName FROM navigationitems ORDER BY itemPosition ASC");
}

// Provera page parametra

function checkPage($side){

    if($side === "admin"){
        if(!isset($_GET["page"])) return "Dashboard";
        else return ucfirst($_GET["page"]);
    }
    elseif($side === "app"){
        if(!isset($_GET["page"])) return "Home";
        else return ucfirst($_GET["page"]);
    }
}

// Dohvatanje svih proizvoda

function getProducts(){

    return executeQuery("SELECT p.productId, p.productName, p.price, b.brandName, i.source FROM products p INNER JOIN brands b ON p.brandId = b.brandId INNER JOIN images i ON p.productId = i.productId WHERE i.imageType = 'Profile' AND p.isDeleted = 0 ORDER BY b.brandName ASC");
}

//Dohvatanje svih brendova

function getBrands(){

    return executeQuery("SELECT * FROM brands WHERE isDeleted = 0 ORDER BY brandName ASC");
}

// Sadržaj head sekcije na app strani

function appHeadContent($page){

    $content = "<link href=\"".BASE_URL."/assets/app/styles/css/style.css\" rel=\"stylesheet\" type=\"text/css\" media=\"all\"><link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css\" integrity=\"sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm\" crossorigin=\"anonymous\"><link href=\"//fonts.googleapis.com/css?family=Londrina+Solid|Coda+Caption:800|Open+Sans\" rel=\"stylesheet\" type=\"text/css\"><title>Mobile-store | ".checkPage("app")."</title><script type=\"text/javascript\" src=\"assets/app/scripts/js/setup.js\"></script>";

    switch($page){

        case "home" :
            $content .= "<link href=\"".BASE_URL."/assets/app/styles/css/responsiveslides.css\" rel=\"stylesheet\" type=\"text/css\"><meta name=\"keywords\" content=\"Mobilestore - Home Keywords\"><script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js\"></script><script src=\"".BASE_URL."/assets/app/scripts/js/responsiveslides.min.js\"></script>";
            break;

        case "about" :
            $content .= "<meta name=\"keywords\" content=\"Mobilestore - About Keywords\">";
            break;

        case "store" :
            $content .= "<meta name=\"keywords\" content=\"Mobilestore - Store Keywords\"><script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js\"></script><script type=\"text/javascript\" src=\"".BASE_URL."/assets/app/scripts/js/jquery.livequery.js\"></script><script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js\"></script><link href=\"".BASE_URL."/assets/app/styles/css/style1.css\" rel=\"stylesheet\" type=\"text/css\"><script src=\"".BASE_URL."/assets/app/scripts/js/products.js\"></script>";
            break;

        case "single" :
            $content .= "<meta name=\"keywords\" content=\"Mobilestore - Single Keywords\"><script src=\"assets/app/scripts/js/jquery.min.js\"></script><script src=\"assets/app/scripts/js/jqzoom.pack.1.0.1.js\" type=\"text/javascript\"></script><link rel=\"stylesheet\" href=\"http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css\"><link rel=\"stylesheet\" href=\"assets/app/styles/css/fontawesome-stars.css\"><link rel=\"stylesheet\" href=\"assets/app/styles/css/flexslider.css\" type=\"text/css\" media=\"screen\"/><script src=\"assets/app/scripts/js/imagezoom.js\"></script><script defer src=\"assets/app/scripts/js/jquery.flexslider.js\"></script><script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js\"></script><script src=\"assets/app/scripts/js/jquery.barrating.min.js\"></script><script src=\"assets/app/scripts/js/products.js\"></script>";
            break;

        case "contact" :
            $content .= "<meta name=\"keywords\" content=\"Mobilestore - Store Keywords\"><link href=\"".BASE_URL."/assets/app/styles/css/style1.css\" type=\"text/css\"><script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js\"></script><script type=\"text/javascript\" src=\"".BASE_URL."/assets/app/scripts/js/jquery.livequery.js\"></script><script type=\"text/javascript\" src=\"".BASE_URL."/assets/app/scripts/js/contact.js\"></script>";
            break;

        case "register" :
            $content .= "<link href=\"".BASE_URL."/assets/app/styles/css/formtemplate.css\" rel=\"stylesheet\" type=\"text/css\"/><link href=\"".BASE_URL."/assets/app/styles/css/formcustom.css\" rel=\"stylesheet\" type=\"text/css\"/><link href=\"".BASE_URL."/assets/app/styles/css/fontawesome-all.css\" rel=\"stylesheet\"/><meta name=\"keywords\" content=\"Mobilestore - Register Keywords\"><script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js\"></script><script src=\"".BASE_URL."/assets/app/scripts/js/register.js\"></script>";
            break;

        case "login" :
            $content .= "<link href=\"".BASE_URL."/assets/app/styles/css/formtemplate.css\" rel=\"stylesheet\" type=\"text/css\"/><link href=\"".BASE_URL."/assets/app/styles/css/formcustom.css\" rel=\"stylesheet\" type=\"text/css\"/><link href=\"".BASE_URL."/assets/app/styles/css/fontawesome-all.css\" rel=\"stylesheet\"/><meta name=\"keywords\" content=\"Mobilestore - Login Keywords\"/><script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js\"></script><script src=\"".BASE_URL."/assets/app/scripts/js/login.js\"></script>";
            break;

        case "profile" :
            $content .= "<link href=\"https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700\" rel=\"stylesheet\"><link href=\"/assets/admin/vendor/nucleo/css/nucleo.css\" rel=\"stylesheet\">

  <link href=\"/assets/admin/vendor/@fortawesome/fontawesome-free/css/all.min.css\" rel=\"stylesheet\"><link href=\"/assets/admin/styles/css/argon.css?v=1.0.0\" rel=\"stylesheet\" type=\"text/css\"/><link href=\"".BASE_URL."/assets/app/styles/css/style.css\" rel=\"stylesheet\" type=\"text/css\" media=\"all\">";
            break;
    }
    return $content;
}

// Vracam broj poseta stranicama

function getVisitedPages($file){

    $aboutC = 0; $storeC = 0; $singleC = 0; $contactC = 0; $registerC = 0; $loginC = 0; $unauthorizedC = 0; $activationC = 0; $homeC = 0; $profileC = 0;

    $openFile = fopen($file, "r");
    $fileData = file($file);
    fclose($openFile);

    foreach($fileData as $key => $value){
        $logDetails = explode("|",$value);
        $url = $logDetails[0];
        $date = $logDetails[1];

        if((time() - 86400) < (int)$date){

            if (strpos($url, "access") === false){

                $urlParticles = explode("/",$url);
                $urlParticlesPage = explode("=",$urlParticles[4]);

                if(strpos($urlParticles[4], "?page") === false){

                    if($urlParticles[4] === "" || $urlParticles[4] !== "models"){

                        $homeC++;
                    }
                }

                else{

                    if(strpos($urlParticlesPage[1], "&") !== false){

                        $pageNamePart =  explode("&",$urlParticlesPage[1]);
                        $pageName = $pageNamePart[0];
                    }
                    else $pageName = trim($urlParticlesPage[1]);

                    switch($pageName){

                        case "about" : $aboutC++; break;

                        case "store" : $storeC++; break;

                        case "single" : $singleC++; break;

                        case "contact" : $contactC++; break;

                        case "register" : $registerC++; break;

                        case "login" : $loginC++; break;

                        case "unauthorized" : $unauthorizedC++; break;

                        case "activation" : $activationC++; break;

                        case "profile" : $profileC++; break;

                        default : $homeC++; break;
                    }
                }
            }
        }
    }
    $urls = [
        ["url" => BASE_URL, "visits" => $homeC],
        ["url" => BASE_URL."/?page=about", "visits" => $aboutC],
        ["url" => BASE_URL."/?page=store", "visits" => $storeC],
        ["url" => BASE_URL."/?page=single", "visits" => $singleC],
        ["url" => BASE_URL."/?page=contact", "visits" => $contactC],
        ["url" => BASE_URL."/?page=register", "visits" => $registerC],
        ["url" => BASE_URL."/?page=login", "visits" => $loginC],
        ["url" => BASE_URL."/?page=unauthorized", "visits" => $unauthorizedC],
        ["url" => BASE_URL."/?page=profile", "visits" => $profileC],
        ["url" => BASE_URL."/?page=activation", "visits" => $activationC]
    ];

    $visits = array_column($urls, "visits");

    array_multisort($visits, SORT_DESC, $urls);

    return $urls;
}

function checkFirstLetterOfString($string){

    $firstLetter = substr($string, 0, 1);
    if($firstLetter === "?") return true; else return false;
}