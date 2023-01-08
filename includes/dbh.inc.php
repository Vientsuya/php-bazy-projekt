<?php

$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "php_projekt";

// $serverName = "localhost";
// $dbUsername = "21_dzierwa";
// $dbPassword = "X1d5a6n7p2";
// $dbName = "21_dzierwa";

$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}