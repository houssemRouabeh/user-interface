<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_interface";

// CONNECTION TO DATABASE
$connection = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
