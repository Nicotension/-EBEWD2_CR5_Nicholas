<?php
session_start();

if (!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) {
    header("Location: ../login.php");
    exit();
}

if (isset($_SESSION["user"])) {
    header("Location ../home.php");
    exit();
}

require_once "../db_connect.php";

if(isset($_GET["id"])) {
    $id = $_GET["id"];


    $sqlSelect = "SELECT picture FROM products WHERE id = {$id}";
    $result = mysqli_query($conn, $sqlSelect);
    $row = mysqli_fetch_assoc($result);

    if($row["picture"] != "product.jpg") {
        unlink("../images/{$row["picture"]}");
    }



    $sql = "DELETE FROM `products` WHERE id = {$id}";
    mysqli_query( $conn, $sql );
    header("Location: index.php");
}

