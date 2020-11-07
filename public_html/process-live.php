<?php


$code = $_POST["code"];
$ext = ".cpp";
if(isset($code) && $code != "") {
    $filename = "../uploads/".uniqid().$ext;
    file_put_contents($filename, $code);

    shell_exec("python3 ../commentator.py ".$filename);

    $newfilename = str_replace($ext, "", $filename).".comments".$ext;


    $comments = file_get_contents($newfilename);



    unlink($filename);
    unlink($newfilename);

    echo $comments;

}