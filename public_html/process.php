<?php
$target_dir = "../uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.<br>";
  $uploadOk = 0;
}
$MEGABYTE = 1000000;
// Check file size
if ($_FILES["fileToUpload"]["size"] > 20 * $MEGABYTE) {
  echo "Sorry, your file is too large.<br>";
  $uploadOk = 0;
}

// Allow certain file formats
if($fileType != "c" && $fileType != "cpp") {
  echo "Sorry, only C and CPP files are allowed.<br>";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.<br>";
// if everything is ok, try to upload file
} else {
  $target_file_hid = $target_dir.uniqid().".".$fileType;
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file_hid)) {
    shell_exec("python3 ../commentator.py ".$target_file_hid);
    $new_file = substr($target_file, 0, -1)."comments.".$fileType;
    $new_file_hid = substr($target_file_hid, 0, -1)."comments.".$fileType;
    header("Content-type: application/x-file-to-save");
    header("Content-Disposition: attachement; filename=".substr($new_file, 11));
    readfile($new_file_hid);
    unlink($target_file_hid);
    unlink($new_file_hid);
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
?>
