<?php

function getAllProducts(){
    return executeQuery("SELECT p.*, b.brandName FROM products p INNER JOIN brands b ON p.brandId = b.brandId WHERE p.isDeleted = 0");
}

function getProduct($productId){

    global $connection;
    $statement = $connection -> prepare("SELECT p.*, i.source, b.brandName, b.brandId FROM products p INNER JOIN images i ON p.productId = i.productId INNER JOIN brands b ON p.brandId = b.brandId WHERE p.isDeleted = 0 AND p.productId = ? AND i.imageType = 'Profile'");
    $statement -> execute([$productId]);
    return $statement -> fetch();
}

function productImage($bigImageName){

    if(isset($_FILES["file"])){

        $imageName = $_FILES["file"]["name"];
        $imageSize = $_FILES["file"]["size"];
        $location = ABSOLUTE_PATH."/assets/admin/images/upload-image/".$imageName;
        $imageType = pathinfo($location,PATHINFO_EXTENSION);
        $valid_extensions = array("jpg","jpeg","png");
        $errors = [];

        if(!in_array(strtolower($imageType),$valid_extensions) )
            array_push($errors,"File type is not ok!");

        if($imageSize > 5242880)
            array_push($errors, "File is too big!");

        if(count($errors) > 0){
//            foreach($errors as $error) :
//                echo $error;
//            endforeach;
        }
        else{
            if(move_uploaded_file($_FILES["file"]["tmp_name"],$location)){

                switch($imageType){

                    case "jpg" :
                        $uploadedImage = imagecreatefromjpeg($location);
                        break;

                    case "jpeg" :
                        $uploadedImage = imagecreatefromjpeg($location);
                        break;

                    case "png" :
                        $uploadedImage = imagecreatefrompng($location);
                        break;
                }

                list($width,$height) = getimagesize($location);

                $bigImageWidth = 160;
                $bigImageHeight = 212;

                $emptyBigImage = imagecreatetruecolor($bigImageWidth,$bigImageHeight);

                imagecopyresampled($emptyBigImage, $uploadedImage, 0, 0, 0, 0, $bigImageWidth, $bigImageHeight, $width, $height);
                $bigImage = $emptyBigImage;

                $timestamp = time();
                $compression = 50;

                switch($imageType){

                    case "jpg" :
                        imagejpeg($bigImage,"{$timestamp}_big.jpg",$compression);
                        $bigBadLocation = ABSOLUTE_PATH."/models/admin/products/{$timestamp}_big.jpg";
                        $bigFinalLocation = ABSOLUTE_PATH."/assets/app/images/phones/profile/{$timestamp}_big.jpg";
                        if(copy($bigBadLocation,$bigFinalLocation)){
                            $bigImageName = "{$timestamp}_big.jpg";
                            unlink($bigBadLocation);
                        }
                        break;

                    case "jpeg" :
                        imagejpeg($bigImage,"{$timestamp}_big.jpeg",$compression);
                        $bigBadLocation = ABSOLUTE_PATH."/models/admin/products/{$timestamp}_big.jpeg";
                        $bigFinalLocation = ABSOLUTE_PATH."/assets/app/images/phones/profile/{$timestamp}_big.jpeg";
                        if(copy($bigBadLocation,$bigFinalLocation)){
                            $bigImageName = "{$timestamp}_big.jpeg";
                            unlink($bigBadLocation);
                        }
                        break;

                    case "png" :
                        imagepng($bigImage,"{$timestamp}_big.png");
                        $bigBadLocation = ABSOLUTE_PATH."/models/admin/products/{$timestamp}_big.png";
                        $bigFinalLocation = ABSOLUTE_PATH."/assets/app/images/phones/profile/{$timestamp}_big.png";
                        if(copy($bigBadLocation,$bigFinalLocation)){
                            $bigImageName = "{$timestamp}_big.png";
                            unlink($bigBadLocation);
                        }
                        break;
                }
            }
        }
    }
    return $bigImageName;
}

function insertNewProduct($model, $price, $brandId, $bigImageName){

    global $connection;

    $statement = $connection -> prepare("INSERT INTO products (productId, productName, price, brandId)VALUES (NULL,?,?,?)");
    $isProductInserted = $statement -> execute([$model, $price, $brandId]);

    $lastInsertedProductId = $connection -> lastInsertId();

    $statement = $connection -> prepare("INSERT INTO images VALUES (NULL, ?, 'Profile', ?)");
    $isImageInserted = $statement -> execute([$bigImageName, $lastInsertedProductId]);

    if($isProductInserted && $isImageInserted) return true;
    else return false;
}

function updateProduct($brandId, $model, $price, $bigImageName, $productId){

    global $connection;
    $statement = $connection -> prepare("UPDATE products SET productName = ?, price = ?, brandId = ? WHERE productId = ?");
    $isProductUpdated = $statement -> execute([$model, $price, $brandId, $productId]);

    $statement = $connection -> prepare("UPDATE images SET source = ? WHERE productId = ?");
    $isImageUpdated = $statement -> execute([$bigImageName, $productId]);

    if($isProductUpdated && $isImageUpdated) return true;
    else return false;
}

function deleteProduct($productId){

    global $connection;
    $statement = $connection -> prepare("UPDATE products SET isDeleted = 1 WHERE productId = ?");
    return $statement -> execute([$productId]);
}