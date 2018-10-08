<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'spiglobal';

$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn){
    echo 'Could not connect to database.'.mysqli_connect_error();
}
