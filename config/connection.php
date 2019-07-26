<?php

require_once "config.php";

logs(LOG);

// PDO konekcija sa bazom podataka
try{
    $connection = new PDO("mysql:host=".SERVER.";dbname=".DATABASE.";charset=utf8", USERNAME, PASSWORD);
    $connection -> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $connection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $exception){
    echo "Error: ".$exception -> getMessage();
}

// Upisivanje logova u log.txt ili unauthorized-access.txt fajl u zavisnosti od privilegija za pristup odredjenim stranicama

function logs($file){

    $openFile = fopen($file, "a");
    if($openFile){
        $date = time();
        fwrite($openFile, "http://{$_SERVER["HTTP_HOST"]}{$_SERVER["REQUEST_URI"]} | {$date} | {$_SERVER["REMOTE_ADDR"]}\n");
        fclose($openFile);
    }
}

// Dohvatanje kolekcije iz baze za prosleđeni upit
function executeQuery($sql){
    global $connection;
    return $connection -> query($sql) -> fetchAll();
}