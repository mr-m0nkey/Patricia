<?php

function uploadImage($file, $former){
  $target_dir = 'plugins/images/users/';
  $target_file = $target_dir . basename($file["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  // Check if image file is a actual image or fake image

  //die(var_dump($file));
  $check = getimagesize($file["tmp_name"]);
  if($check !== false) {
      $uploadOk = 1;
  } else {
      addToSession('update_error', 'File is not an image');
      $uploadOk = 0;
  }
  // Check if file already exists
  if($former !== "default.jpg"){
    unlink($target_dir.$former);
  }
  // Check file size
  if ($file["size"] > 500000) {
      addToSession('update_error', 'Sorry, your file is too large');
      $uploadOk = 0;
  }
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
    addToSession('update_error', 'Sorry, only JPG, JPEG, PNG & GIF files are allowed');
      $uploadOk = 0;
  }
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    return false;
  // if everything is ok, try to upload file
  } else {
    $target_file = $target_dir . $_SESSION['user_id'].'.'.$imageFileType;

      if (move_uploaded_file($file["tmp_name"], $target_file)) {
          return $_SESSION['user_id'].'.'.$imageFileType;
      } else {
        addToSession('update_error', 'Sorry, there was an error uploading your file');
      }
  }



}

 ?>
