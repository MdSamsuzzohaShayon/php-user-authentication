<?php

$server = 'localhost';
$username = 'shayon';
$password = 'Shayon1234';
$database = 'loginsystem';

$conn = new mysqli($server, $username, $password, $database);
if($conn->mysqli_errno){
    echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
    die('Connection failed');
}
echo $conn->host_info . "\n";