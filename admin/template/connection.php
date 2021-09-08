<?php
ob_start();
$serverName = "localhost";     // Server Name
$dbName = "blog";              // DataBase Name
$userName = "root";          // User Name
$pass = "";                 // Password

$conn = mysqli_connect($serverName, $userName, $pass, $dbName);
