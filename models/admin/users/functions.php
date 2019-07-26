<?php

function getUsers(){

    return executeQuery("SELECT u.userId, u.firstName, u.lastName, u.username, u.email, u.dateOfBirth, u.dateOfRegistration, u.active, r.roleName FROM users u INNER JOIN roles r ON u.roleId = r.roleId WHERE u.isDeleted = 0 ORDER BY u.dateOfRegistration DESC");

}

// Dohvatanje jednog korisnika po prosledjenom id-u

function getUser($userId){

    global $connection;
    $statement = $connection -> prepare("SELECT u.userId, u.firstName, u.lastName, u.username, u.email, u.dateOfBirth, u.dateOfRegistration,u.imageSmall, u.imageBig, u.active, r.roleName FROM users u INNER JOIN roles r ON u.roleId = r.roleId WHERE u.isDeleted = 0 AND u.userId = ?");
    $statement -> execute([$userId]);
    return $statement -> fetch();
}

function getOnlineUsers(){

    global $connection;

    try{
        $numberOfUsers = $connection -> query("SELECT COUNT(isOnline) AS numOfUsers FROM users WHERE isOnline = 1") -> fetch();
    }
    catch(PDOException $exception){
        echo "Error: ".$exception -> getMessage();
    }

    return (string)$numberOfUsers -> numOfUsers;
}

function insertNewUserFromAdmin($firstName, $lastName, $username, $email, $password, $securityToken, $dateOfRegistration, $active, $role, $dateOfBirth, $imageBig, $imageSmall){

    global $connection;
    $hashedPassword = hash("sha512",$password.$securityToken);

    $statement = $connection -> prepare("INSERT INTO users VALUES (NULL,?,?,?,?,?,?,NULL,?,?,?,?,?,0,0,?)");
    return $statement -> execute([$firstName, $lastName, $username, $email, $hashedPassword, $securityToken, $dateOfBirth, $dateOfRegistration, $imageSmall, $imageBig, $active, $role]);
}

function image($bigImageName, $smallImageName){

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

                $bigImageWidth = 1000;
                $bigImageHeight = 1000;

                $smallImageWidth = 500;
                $smallImageHeight = 500;

                $emptyBigImage = imagecreatetruecolor($bigImageWidth,$bigImageHeight);
                $emptySmallImage = imagecreatetruecolor($smallImageWidth,$smallImageHeight);

                imagecopyresampled($emptyBigImage, $uploadedImage, 0, 0, 0, 0, $bigImageWidth, $bigImageHeight, $width, $height);
                $bigImage = $emptyBigImage;

                imagecopyresampled($emptySmallImage, $uploadedImage, 0, 0, 0, 0, $smallImageWidth, $smallImageHeight, $width, $height);
                $smallImage = $emptySmallImage;

                $timestamp = time();
                $compression = 50;

                switch($imageType){

                    case "jpg" :
                        imagejpeg($bigImage,"{$timestamp}_big.jpg",$compression);
                        $bigBadLocation = ABSOLUTE_PATH."/models/admin/users/{$timestamp}_big.jpg";
                        $bigFinalLocation = ABSOLUTE_PATH."/assets/app/images/users/profile/big/{$timestamp}_big.jpg";
                        imagejpeg($smallImage,"{$timestamp}_small.jpg",$compression);
                        $smallBadLocation = ABSOLUTE_PATH."/models/admin/users/{$timestamp}_small.jpg";
                        $smallFinalLocation = ABSOLUTE_PATH."/assets/app/images/users/profile/small/{$timestamp}_small.jpg";
                        if(copy($bigBadLocation,$bigFinalLocation) && copy($smallBadLocation,$smallFinalLocation)){
                            $bigImageName = "{$timestamp}_big.jpg";
                            $smallImageName = "{$timestamp}_small.jpg";

                            unlink($bigBadLocation);
                            unlink($smallBadLocation);
                        }
                        break;

                    case "jpeg" :
                        imagejpeg($bigImage,"{$timestamp}_big.jpeg",$compression);
                        $bigBadLocation = ABSOLUTE_PATH."/models/admin/users/{$timestamp}_big.jpeg";
                        $bigFinalLocation = ABSOLUTE_PATH."/assets/app/images/users/profile/big/{$timestamp}_big.jpeg";
                        imagejpeg($smallImage,"{$timestamp}_small.jpeg",$compression);
                        $smallBadLocation = ABSOLUTE_PATH."/models/admin/users/{$timestamp}_small.jpeg";
                        $smallFinalLocation = ABSOLUTE_PATH."/assets/app/images/users/profile/small/{$timestamp}_small.jpeg";
                        if(copy($bigBadLocation,$bigFinalLocation) && copy($smallBadLocation,$smallFinalLocation)){
                            $bigImageName = "{$timestamp}_big.jpeg";
                            $smallImageName = "{$timestamp}_small.jpeg";

                            unlink($bigBadLocation);
                            unlink($smallBadLocation);
                        }
                        break;

                    case "png" :
                        imagepng($bigImage,"{$timestamp}_big.png");
                        $bigBadLocation = ABSOLUTE_PATH."/models/admin/users/{$timestamp}_big.png";
                        $bigFinalLocation = ABSOLUTE_PATH."/assets/app/images/users/profile/big/{$timestamp}_big.png";
                        imagepng($smallImage,"{$timestamp}_small.png");
                        $smallBadLocation = ABSOLUTE_PATH."/models/admin/users/{$timestamp}_small.png";
                        $smallFinalLocation = ABSOLUTE_PATH."/assets/app/images/users/profile/small/{$timestamp}_small.png";
                        if(copy($bigBadLocation,$bigFinalLocation) && copy($smallBadLocation,$smallFinalLocation)){
                            $bigImageName = "{$timestamp}_big.png";
                            $smallImageName = "{$timestamp}_small.png";

                            unlink($bigBadLocation);
                            unlink($smallBadLocation);
                        }
                        break;
                }
            }
        }
    }
    return [$bigImageName, $smallImageName];
}

function updateUser($userId, $firstName, $lastName, $dateOfBirth, $imageSmall, $imageBig, $role){

    global $connection;
    $statement = $connection -> prepare("UPDATE users SET firstName = ?, lastName = ?, dateOfBirth = ?, imageSmall = ?, imageBig = ?, roleId = ? WHERE userId = ?");
    return $statement -> execute([$firstName, $lastName, $dateOfBirth, $imageSmall, $imageBig, $role, $userId]);
}

function deleteUser($userId){

    global $connection;
    $statement = $connection -> prepare("UPDATE users SET isDeleted = 1 WHERE userId = ?");
    return $statement -> execute([$userId]);
}