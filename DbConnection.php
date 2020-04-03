<?php

$servername = '127.0.0.1:3306';
$username = 'root';
$password = '';
$database = 'horse';

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection faled :" . $conn->connect_error);
}