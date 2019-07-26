<?php

header("Content-Type: application/json");

require_once "../../../config/connection.php";

$code = 500;

if($_SERVER["REQUEST_METHOD"] !== "POST"){

    $code = 405;
    logs(UNAUTHORIZED_ACCESS);
}

else{
    include "functions.php";

    $rating = $_POST["rating"];
    $userId = $_POST["userId"];
    $productId = $_POST["productId"];

    try{
        $isInserted = insertRating($userId,$productId,$rating);

        if(!$isInserted) $code = 500;
        else{
            $response = returnRatingInfoBack($userId,$productId);
            $response += array("rating" => $rating);

            $insertAverageRating = insertAvgRating($response["averageRating"],$productId);
            $code = 201;
            echo json_encode($response);
        }
    }
    catch(PDOException $e){

        $code = 500;
        echo json_encode(["error" => $e -> getMessage()]);
    }
}
http_response_code($code);