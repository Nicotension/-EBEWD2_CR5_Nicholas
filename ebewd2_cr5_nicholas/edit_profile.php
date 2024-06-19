<?php
   session_start();
   
   if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])){
    header("Location: login.php");
    exit();
   }
   require_once "db_connect.php";
   require_once "file_upload.php";


   $id = isset($_SESSION["adm"]) ? $_SESSION["adm"] : $_SESSION["user"];
   $backLink = isset($_SESSION["adm"]) ? "dashboard.php" : "home.php";
   $sql = "SELECT * FROM users WHERE id = {$id}";
   $result = mysqli_query($conn, $sql);
   $row = mysqli_fetch_assoc($result);

$fnameError = $lnameError = $phone_numberError =  $addressError = $dateError = "";

if(isset($_POST["update"])){
    $first_name = cleanInputs($_POST["first_name"]);
    $last_name = cleanInputs($_POST["last_name"]);
    $phone_number = cleanInputs($_POST["phone_number"]);
    $address = cleanInputs($_POST["address"]);
    $date_of_birth = cleanInputs($_POST["date_of_birth"]);
    $picture = fileUpload($_FILES["picture"]);
    if (empty($first_name)) {
        $error = true;
        $fnameError = "Please, type your first name!";
    }elseif (strlen($first_name) < 3) {
        $error = true;
        $fnameError = "First name must have at least 3 chars!";
    }elseif (!preg_match("/^[a-zA-Z\s]+$/", $first_name)) {
        $error = true;
        $fnameError = "First name contain only letters and spaces!";
    }
       
    if (empty($last_name)) {
        $error = true;
        $lnameError = "Please, type your last name!";
    }elseif (strlen($last_name) < 3) {
        $error = true;
        $lnameError = "Last name must have at least 3 chars!";
    }elseif (!preg_match("/^[a-zA-Z\s]+$/", $last_name)) {
        $error = true;
        $lnameError = "Last name contain only letters and spaces!";
    }
    if (empty($phone_number)) {
      $error = true;
      $phone_numberError = "Please, enter your phone number!";
  }elseif (strlen($phone_number) < 3) {
      $error = true;
      $phone_numberError = "Phone number must have at least 11 numbers!";
  // }elseif (!preg_match("/^[a-zA-Z\s]+$/", $phone_number)) {
  //     $error = true;
  //     $phone_numberError = "Phone number can only contain numbers!";
  }
  if (empty($address)) {
      $error = true;
      $addressError = "Please, type your first name!";
  }elseif (strlen($address) < 3) {
      $error = true;
      $addressError = "Address must have at least 3 chars!";
  // }elseif (!preg_match("/^[a-zA-Z\s]+$/", $address)) {
  //     $error = true;
  //     $addressError = "Address must contain only letters and spaces!";
  }
    if (empty($date_of_birth)) {
        $error = true;
        $dateError = "Date of birth can't be empty!";
    }

    if(!$error){
        if($_FILES["picture"]["error"] == 4){
            $sqlUpdate = "UPDATE `users` SET `first_name` = '{$first_name}',`last_name` = '{$last_name}', `phone_number` = '{$phone_number}', `address` = '{$address}',`date_of_birth` = '{$date_of_birth}' WHERE id = $id";
        }else {
            $sqlUpdate = "UPDATE `users` SET `first_name` = '{$first_name}', `last_name` = '{$last_name}', `phone_number` = '{$phone_number}', `address` = '{$address}',`date_of_birth` = '{$date_of_birth}',`picture` = '{$picture[0]}' WHERE id = $id";
        }
       if(mysqli_query($conn, $sqlUpdate)) {
          header("Location: ". $backLink);
       }
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity=
    "sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/home.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="reset_password.php">Reset password</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Edit profile</a>
        </li>
      </ul>
        <div>
        <div class="d-flex">
            <a class="btn btn-danger" href="logout.php?logout">Logout</a>
        </div>  
    </div>
  </div>
</nav> 

<form method="post" enctype="multipart/form-data">
    <input type="text" class="form-control" placeholder="First name" name= "first_name" value="<?= $row["first_name"] ?>">
     <p class="text-danger"><?= $fnameError; ?></p>
     <input type="text" class="form-control" placeholder="Last name" name= "last_name" value="<?= $row["last_name"] ?>">
     <p class="text-danger"><?= $lnameError; ?></p>
     <input type="text" class="form-control" placeholder="Phone number" name= "phone_number" value="<?= $row["phone_number"] ?>">
     <p class="text-danger"><?= $phone_numberError; ?></p>
     <input type="text" class="form-control" placeholder="Address" name= "address" value="<?= $row["address"] ?>">
     <p class="text-danger"><?= $addressError; ?></p>
     <input type="file" class="form-control" name= "picture">
     <input type="date" class="form-control"name= "date_of_birth" value="<?= $row["date_of_birth"] ?>">
     <p class="text-danger"><?= $dateError ?></p>
     <input type="submit" class="btn btn-success" value="Update" name="update">
     <a class="btn btn-warning" href="<?= $backLink ?>">Back</a>
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity=
"sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>



