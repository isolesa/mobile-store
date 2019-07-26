<?php

function getNewSetOfProducts($operation, $sort, $brand, $productsPerPage, $page){

    global $connection;
    $newValueOfPage = getPageByOperation($operation, $page);

    if((int)$brand === 0 || $brand === "all"){
        $sql = "SELECT p.productId, p.productName, p.price, b.brandName, i.source FROM products p INNER JOIN brands b ON p.brandId = b.brandId INNER JOIN images i ON p.productId = i.productId WHERE p.isDeleted = 0 AND i.imageType = 'Profile'".orderBy($sort).limit($newValueOfPage, $productsPerPage);
        return $connection -> query($sql) -> fetchAll(PDO::FETCH_ASSOC);
    }
    else{
        $sql = "SELECT p.productId, p.productName, p.price, b.brandName, i.source FROM products p INNER JOIN brands b ON p.brandId = b.brandId INNER JOIN images i ON p.productId = i.productId WHERE p.isDeleted = 0 AND i.imageType = 'Profile' AND b.brandId = ? ".orderBy($sort).limit($newValueOfPage, $productsPerPage);
        $statement = $connection -> prepare($sql);
        $statement -> execute([$brand]);
        $products = $statement -> fetchAll(PDO::FETCH_ASSOC);
        return $products;
    }
}

// Kreiranje dela upita za sortiranje proizvoda

function orderBy($sort){

    switch($sort){

        case 1 :
            return " ORDER BY b.brandName ASC, p.productName ASC";
            break;

        case 2 :
            return " ORDER BY b.brandName DESC, p.productName DESC";
            break;

        case 3 :
            return " ORDER BY p.price DESC";
            break;

        case 4 :
            return " ORDER BY p.price ASC";
            break;

        default :
            return " ORDER BY b.brandName ASC, p.productName ASC";
            break;
    }
}

// Izračunavanje broja proizvoda po brendu

function getNumberOfProducts($brand){

    global $connection;
    if((int)$brand === 0 || $brand === "all"){
        return count($connection -> query("SELECT productId FROM products WHERE isDeleted = 0") -> fetchAll());
    }
    else{
        $statement = $connection -> prepare("SELECT productId FROM products WHERE isDeleted = 0 AND brandId = ?");
        $statement -> execute([$brand]);
        $products = $statement -> fetchAll();
        return count($products);
    }
}

// Pripremam podatke vezane za paginaciju

function getNumberOfPages($productsPerPage, $brand){

    $numberOfProducts = getNumberOfProducts($brand);
    $numberOfPages = ceil($numberOfProducts / $productsPerPage);
    return $numberOfPages;
}

// Postavljam limit za sql upit
// Od kog proizvoda počinjem sa selekcijom i koliko narednih proizvoda selektujem (SQL LIMIT)

function limit($page, $productsPerPage){

    $firstResult = ($page - 1) * $productsPerPage;
    return " LIMIT ".$firstResult.", ".$productsPerPage;
}



// Indirektno odredjujem na koju stranicu bi trebalo da se prebacim
function getPageByOperation($operation, $page){

    switch($operation){

        case "sorting" : return 1; break;

        case "filtering" : return 1; break;

        case "pagination" : return $page; break;

        default : return $page; break;
    }
}

function insertRating($userId, $productId, $ratingValue){

    $flag = false;
    $ratingFile = fopen(RATING,"r");
    $ratings = file(RATING);
    fclose($ratingFile);
    $date = time();

    foreach($ratings as $rating){
        $parts = explode(";",trim($rating));

        if($parts[0] === $userId){
            if($parts[1] === $productId){
                $flag = true;
                break;
            }
        }
        else $flag = false;
    }

    if($flag){
        $updateRatings = fopen(RATING,"w");
        $newContent = "";

        foreach($ratings as $rating){
            $parts = explode(";",trim($rating));

            if($parts[0] === $userId){
                if($parts[1] === $productId){
                    $newContent .= "{$userId};{$productId};{$ratingValue};{$date}\n";
                    continue;
                }
            }
            $newContent .= $rating;
        }

        fwrite($updateRatings,$newContent);
        fclose($updateRatings);
        return true;
    }
    else{
        $insertRating = fopen(RATING,"a");
        fwrite($insertRating,"{$userId};{$productId};{$ratingValue};{$date}\n");
        fclose($insertRating);
        return true;
    }
}

function returnRatingInfoBack($userId, $productId){

    $counter = 0; $userRating = null; $sum = 0;
    $openRatingFile = fopen(RATING,"r");
    $ratings = file(RATING);
    fclose($openRatingFile);

    foreach($ratings as $rating){
        $parts = explode(";",$rating);

        if($parts[0] === $userId && $parts[1] === $productId) $userRating = $parts[2];

        if($parts[1] === $productId){
            $counter++;
            $sum = $sum + (int)$parts[2];
        }
    }
    $numberOfVotes = $counter;

    if($numberOfVotes !== 0) $averageRating = round($sum / $numberOfVotes,2);

    if($numberOfVotes === 0) $averageRating = "Not rated";

    $response = ["averageRating" => $averageRating,"numberOfVotes" => $numberOfVotes];
    return $response;
}

function getProduct($productId){

    global $connection;

    $statement = $connection -> prepare("SELECT p.productId, p.productName, p.description, p.price, FLOOR(p.price - p.price * p.sale / 100) AS newPrice, b.brandName, i.source FROM products p LEFT OUTER JOIN images i ON p.productId = i.productId INNER JOIN brands b ON p.brandId = b.brandId WHERE p.isDeleted = 0 AND p.productId = ?");
    $statement -> execute([$productId]);
    $product = $statement ->  fetch();
    return $product;
}

function getLatest(){

    return executeQuery("SELECT p.productId, p.productName, FLOOR(p.price - p.price * p.sale / 100) AS newPrice, b.brandName, i.source, p.published FROM products p LEFT OUTER JOIN images i ON p.productId = i.productId INNER JOIN brands b ON p.brandId = b.brandId WHERE p.isDeleted = 0 ORDER BY p.published DESC LIMIT 0,4");
}

function insertAvgRating($avgRating, $productId){

    global $connection;

    $statement = $connection -> prepare("UPDATE products SET averageRating = ? WHERE productId = ?");
    return $statement -> execute([$avgRating,$productId]);
}

function getTopRated(){

    return executeQuery("SELECT p.productId, p.productName, FLOOR(p.price - p.price * p.sale / 100) AS newPrice, b.brandName, i.source, p.averageRating FROM products p LEFT OUTER JOIN images i ON p.productId = i.productId INNER JOIN brands b ON p.brandId = b.brandId WHERE p.isDeleted = 0 ORDER BY p.averageRating DESC LIMIT 0,4");
}

function getDealsOfTheDay(){

    return executeQuery("SELECT p.productId, p.productName, FLOOR(p.price - p.price * p.sale / 100) AS newPrice, b.brandName, i.source, p.sale FROM products p LEFT OUTER JOIN images i ON p.productId = i.productId INNER JOIN brands b ON p.brandId = b.brandId WHERE p.isDeleted = 0 ORDER BY p.sale DESC LIMIT 0,4");
}