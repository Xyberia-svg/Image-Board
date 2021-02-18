<?php

require_once './Controls.php';
require_once './Image.php';

$uploadDir = "upload/";
$response = array(
    'status' => 1,
    'message' => 'Oops! File size too big'
);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // add comment :
    // insert comment content 
    // insert username
    // insert img infos (name, size, date)
    // retreive comment infos (content, username, img infos)

    // UPLOAD IMAGE
    // SAVE IMAGE AND USER INFOS IN DATABASE
    $comment = $_POST['comment'];
    $username = $_POST['user'];
    $threadID = $_POST['threadID'];
    $imgName = $_FILES['file']['name'];
    $imgSize = $_FILES['file']['size'];
    $imgDate = date("Y-m-d G:i:s");

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
    $controls = new Controls();
    $image = new Image($imgName, $imgSize, $imgDate);
    $commentInfos = $controls->addComment($username, $comment, $image, $threadID);
    $responseArray = array(
        'infos' => $commentInfos,
        'status' => $response['status'],
        'message' => $response['message']
    );
    echo json_encode($responseArray);
}
