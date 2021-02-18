<?php 
session_start();
require_once './Controls.php';

$user = $_POST['user'];
$content = $_POST['content'];
$title = $_POST['title'];
$imgName = $_FILES['file']['name'];
$imgSize = $_FILES['file']['size'];
$date = date("Y-m-d G:i:s");

$uploadDir = "upload/";
$response = array(
    'status' => 1,
    'message' => 'Oops! File size too big'
);

if ($_FILES['file']['size'] < 3000000) {
    $allowedTypes = array('jpg', 'png', 'jpeg', 'gif');
    $fileName = basename($imgName);
    $filePath = $uploadDir . $fileName;
    $fileType = pathinfo($filePath, PATHINFO_EXTENSION);

    if (in_array($fileType, $allowedTypes)) {
        if (move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {

            $response['status'] = 2;
            $response['message'] = 'File uploaded successfully!';
        }
    } else {
        $response['status'] = 3;
        $response['message'] = 'File format not allowed!';
    }
}

$ctrl = new Controls();
$ctrl->insertThread($title, $user, $content, $imgName, $date);

$_SESSION['threadArr'] = array(
    'title' => $title,
    'user' => $user,
    'content' => $content,
    'fname' => $imgName,
    'date' => $date
);

header('location: threadTemplate.php');



?>