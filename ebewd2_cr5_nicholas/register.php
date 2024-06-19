<?php
session_start();

if (isset($_SESSION["user"])) {
    header("Location: home.php");
    exit();
}
if (isset($_SESSION["adm"])) {
    header("Location: dashboard.php");
    exit();
}

require_once "db_connect.php";
require_once "file_upload.php";


$error = false;
$fnameError = $emailError = $phone_numberError = $addressError = $dateError = $lnameError = $passwordError = $first_name = $last_name = $email = $phone_number = $address = $date_of_birth = "";


if(isset($_POST["register"])) {
    $first_name = cleanInputs($_POST["first_name"]);
    $last_name = cleanInputs($_POST["last_name"]);
    $email = cleanInputs($_POST["email"]);
    $phone_number = cleanInputs($_POST["phone_number"]);
    $address = cleanInputs($_POST["address"]);
    $password = cleanInputs($_POST["password"]);
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

    if (empty($password)) {
        $error = true;
        $passwordError = "Password can't be empty";
    }elseif(strlen($password) < 6) {
        $error = true;
        $passwordError = "Password must be at least 6 chars!";
    }

    if (empty($email)) {
        $error = true;
        $emailError = "Email can't be empty!";
    }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $error = true;
       $emailError = "Please enter a valid email address!";
    }else{
       $query = "SELECT email FROM `users` WHERE email = '{$email}'";
       $result = mysqli_query($conn, $query);
       if (mysqli_num_rows($result) != 0) {
        $error = true;
        $emailError = "Email already in use!";

       }
    }

    if (empty($date_of_birth)) {
        $error = true;
        $dateError = "Date of birth can't be empty!";
    }

    if(!$error) {
        $password = hash("sha256", $password);
        
         $sql = "INSERT INTO `users`(`first_name`, `last_name`, `password`, `date_of_birth`, `email`, `phone_number`, `address`, `picture`) VALUES ('{$first_name}', '{$last_name}','{$password}', '{$date_of_birth}','{$email}','{$phone_number}','{$address}','{$picture[0]}')";
         $result = mysqli_query($conn, $sql);
         if ($result){
            echo "<div class='alert-success'>
            <p>New account has been created, $picture[1]</p>
            </div>";
            $first_name = $last_name = $email = $phone_number = $address = $date_of_birth = "";
         }else{
            echo "<div class='alert-danger'>
            <p>Something went wron, please try again later!</p>
            </div>";
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
<?php require_once "components/navbar.php"; ?>
    <div class="container">
        <h1 class="text-center">Register form</h1>
    <form method="post" enctype="multipart/form-data" autocomplete="off">
     <input type="text" class="form-control" placeholder="First name" name= "first_name" value="<?= $first_name ?>">
     <p class="text-danger"><?= $fnameError; ?></p>
     <input type="text" class="form-control" placeholder="Last name" name= "last_name" value="<?= $last_name ?>">
     <p class="text-danger"><?= $lnameError; ?></p>
     <input type="email" class="form-control" placeholder="Email" name= "email" value="<?= $email ?>"> 
     <p class="text-danger"><?= $emailError; ?></p>
     <input type="number" class="form-control" placeholder="Phone number" name= "phone_number" value="<?= $phone_number ?>"> 
     <p class="text-danger"><?= $phone_numberError; ?></p>
     <input type="address" class="form-control" placeholder="Address" name= "address" value="<?= $address ?>"> 
     <p class="text-danger"><?= $addressError; ?></p>
     <input type="password" class="form-control" placeholder="Password" name= "password">
     <p class="text-danger"><?= $passwordError; ?></p>
     <input type="file" class="form-control" name= "picture">
     <input type="date" class="form-control"name= "date_of_birth" value="<?= $date_of_birth ?>">
     <p class="text-danger"><?= $dateError ?></p>
     <input type="submit" class="btn btn-success" value="register" name="register">
</form>
    </div>

</body>
</html>