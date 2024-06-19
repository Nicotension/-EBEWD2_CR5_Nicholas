<?php

$userName = "root";
$hostName = "localhost";
$password = "";
$dbName = "ebewd2_cr5_animal_adoption_nicholas";

$conn = mysqli_connect($hostName, $userName, $password, $dbName);

// $userName = "root";
// $hostName = "localhost";
// $password = "";
// $dbName = "login";

// $conn = mysqli_connect($hostName, $userName, $password, $dbName);

function cleanInputs($value)
{
    $data = trim($value);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);

    return $data;
}


