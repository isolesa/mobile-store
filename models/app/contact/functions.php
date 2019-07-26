<?php

function insertMessage($name, $email, $subject){

    global $connection;
    $statement = $connection -> prepare("INSERT INTO messages VALUES (NULL, ?, ?, ?)");
    return $statement -> execute([$name,$email,$subject]);
}