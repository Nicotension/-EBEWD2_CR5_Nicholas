<?php
  
    function fileUpload($picture, $source = "user") 
    {
        if($picture["error"] == 4){

            $pictureName = "avatar.png"; 
            if($source == "product"){
                $pictureName = "product.jpg";
            }
            $message = "No picture has been chosen, but you can upload one later !";
        }else {
            $checkIfImage = getImagesize($picture["tmp_name"]);
            $message = $checkIfImage ? "ok" : "Not an image";
        }

        if($message == "ok"){
            $ext = strtolower(pathinfo($picture["name"], PATHINFO_EXTENSION));
            $pictureName = uniqid("") . ".". $ext;
            $destination = "images/{$pictureName}";
            if($source == "product"){
                $destination = "../images/{$pictureName}";
            }
            move_uploaded_file($picture["tmp_name"], $destination);
        }
        return [$pictureName, $message];

    }
