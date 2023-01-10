<?php

function upload(){
    $name = $_FILES['image']['name'];
    $err = $_FILES['image']['error'];
    $tmp = $_FILES['image']['tmp_name'];

    // gambar harus di upload dulu 
    if ($err === 4) return false;

    $supportedFile = ['jpg', 'jpeg', 'png'];
    $isImage = explode('.', $name);
    $isImage = strtolower(end($isImage));

    // cek eksitensi yang di upload
    if (!in_array($isImage, $supportedFile)) return false;

    $newName = uniqid();
    $newName .= '.';
    $newName .= $isImage;

    move_uploaded_file($tmp, 'assets/images/' . $newName);

    return $newName;
}