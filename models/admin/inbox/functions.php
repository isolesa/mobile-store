<?php

function getMessages(){
    return executeQuery("SELECT * FROM messages");
}