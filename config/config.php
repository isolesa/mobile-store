<?php

// Osnovna podešavanja

define("BASE_URL", "http://localhost/mobile-store-master");
define("ABSOLUTE_PATH", $_SERVER["DOCUMENT_ROOT"]."/mobile-store-master");

// Definisanje konstanti za putanje do fajlova
define("ENV", ABSOLUTE_PATH."/config/.env");
define("LOG", ABSOLUTE_PATH."/data/logs/logs.txt");
define("UNAUTHORIZED_ACCESS", ABSOLUTE_PATH."/data/logs/unauthorized-access.txt");
define("RATING", ABSOLUTE_PATH."/data/ratings/ratings.txt");

// Podešavanja baze podataka
define("SERVER", env("SERVER"));
define("DATABASE", env("DATABASE"));
define("USERNAME", env("USERNAME"));
define("PASSWORD", env("PASSWORD"));

// Preuzimanje parametara za konekciju sa bazom podataka
function env($constantName){

    $openEnvFile = fopen(ENV,"r");
    $envData = file(ENV);
    fclose($openEnvFile);
    $constantValue = "";

    foreach($envData as $key => $value){
        $config = explode(":",$value);
        if(trim($config[0]) === $constantName) $constantValue = trim($config[1]);
    }

    return $constantValue;
}