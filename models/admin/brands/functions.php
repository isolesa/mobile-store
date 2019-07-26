<?php

function getAllBrands(){
    return executeQuery("SELECT * FROM brands WHERE isDeleted = 0");
}

// Dohvatanje jednog brenda za prosledjeni id

function getBrand($brandId){

    global $connection;
    $statement = $connection -> prepare("SELECT * FROM brands WHERE isDeleted = 0 AND brandId = ?");
    $statement -> execute([$brandId]);
    return $statement -> fetch();
}

function insertNewBrand($brandName){

    global $connection;
    $statement = $connection -> prepare("INSERT INTO brands VALUES (NULL, ?, 0)");
    return $statement -> execute([$brandName]);

}

function updateBrand($brandName, $brandId){

    global $connection;
    $statement = $connection -> prepare("UPDATE brands SET brandName = ? WHERE brandId = ?");
    return $statement -> execute([$brandName, $brandId]);
}

function deleteBrand($brandId){

    global $connection;
    $statement = $connection -> prepare("UPDATE brands SET isDeleted = 1 WHERE brandId = ?");
    return $statement -> execute([$brandId]);
}