<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'inventory_ajax';

$conn = new mysqli($host, $user, $pass, $db);

if(!$conn){
    echo 'Database connection error';
}

?>
