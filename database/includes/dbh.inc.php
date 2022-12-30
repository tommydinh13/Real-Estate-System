<?php

$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "real_estate";

$conn = mysqli_connect($servername, $dbUsername,$dbPassword,$dbName);

if(!$conn){
    // die("Connection Failed: ".mysqli_connect_error());
    echo "failed to connect to sql: ".mysqli_coonect_error();
}