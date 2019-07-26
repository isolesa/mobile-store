<?php

// Proveravam da li postoji korisnik sa unetom email adresom i poredim uneti password u kombinaciji sa "security" tokenom, sa password-om iz baze

function checkUser($email,$password){

    global $connection;

    $statement = $connection -> prepare("SELECT u.userId, u.firstName, u.lastName, u.username, u.password, u.securityToken, u.imageSmall AS small, u.imageBig, r.roleId FROM users u INNER JOIN roles r ON u.roleId = r.roleId WHERE u.email = ? AND u.active = 1 AND u.isDeleted = 0");
    $statement -> execute([$email]);
    $user = $statement -> fetch();
    if($user){
        $securityToken = $user -> securityToken;
        $hashedPassword = hash("sha512", $password.$securityToken);

        if($user -> password === $hashedPassword) return $user;
        else return false;
    }
    else return false;
}

// Provera jedinstvenosti username-a

function checkUsername($username){

    global $connection;

    $statement = $connection -> prepare("SELECT username FROM users WHERE username = ?");
    $statement -> execute([$username]);
    $isExists = $statement -> fetchAll();

    if(count($isExists) > 0) return true;
    else return false;
}

// Provera jedinstvenosti email-a

function checkEmail($email){

    global $connection;
    $statement = $connection -> prepare("SELECT email FROM users WHERE email = ?");
    $statement -> execute([$email]);
    $isExists = $statement -> fetchAll();

    if(count($isExists) > 0) return true;
    else return false;
}

// Upisujem novog korisnika u bazu podataka
// U slučaju da se baza kompromituje nekako, biće skoro nemoguće provaliti bilo koji korisnički password ako se skladišti u bazi u kombinaciji sa tokenom i kriptuje sha2 algoritmom

function insertNewUser($firstName, $lastName, $username, $email, $password, $securityToken, $confirmationToken, $dateOfRegistration, $active, $role){

    global $connection;
    $hashedPassword = hash("sha512",$password.$securityToken);
    $statement = $connection -> prepare("INSERT INTO users VALUES (NULL,?,?,?,?,?,?,?,NULL,?,'defaultSmall.jpg','defaultBig.jpg',?,0,0,?)");

    return $statement -> execute([$firstName, $lastName, $username, $email, $hashedPassword, $securityToken, $confirmationToken, $dateOfRegistration, $active, $role]);
}

// Funkcija za kreiranje tokena

function createToken($length){

    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $token = "";

    for($i = 0; $i < $length; $i++)
        $token .= $characters[rand(0, $charactersLength - 1)];

    return $token;
}

// Proveravam da li u bazi postoji neaktivan korisnik sa pristiglim tokenom (Srediti!)

function checkToken($token){

    global $connection;

    $statement = $connection -> prepare("SELECT userId, firstName, lastName, username, roleId, active FROM users WHERE confirmationToken = ?");
    $statement -> execute([$token]);
    $user = $statement -> fetch();

    if(!$user) return 1;
    elseif((int)$user -> active) return 2;
    else{
        $userId = $user -> userId;
        $update = $connection -> query("UPDATE users SET active = 1 WHERE userId = ".$userId);
        if(!$update) return 3;
        else return $user;
    }
}

function setOnlineStatus($userId){

    global $connection;

    $statement = $connection -> prepare("UPDATE users SET isOnline = 1 WHERE userId = ?");
    return $statement -> execute([$userId]);
}

function unsetOnlineStatus($userId){

    global $connection;

    $statement = $connection -> prepare("UPDATE users SET isOnline = 0 WHERE userId = ?");
    return $statement -> execute([$userId]);
}

