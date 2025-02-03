<?php


$host =  "localhost";
$username = "root";
$password = "";
$database = "ide_kreatif";


$conn = mysqli_connect($host, $username, $password, $database);


if ($conn->connect_error) {

    die("Database gagal terkoneksi: " . $conn->connect_error);
}

?>