<?php
include "../connect.php";

// Set content type to JSON
header('Content-Type: application/json');

if (isset($_POST['name']) && 
    isset($_POST['number']) && 
    isset($_POST['text']) &&
    isset($_FILES['image'])) {

    $name = $_POST['name'];
    $number = $_POST['number'];
    $text = $_POST['text'];

    // Check if file is uploaded
    if (isset($_FILES['image'])) {
        $image = $_FILES['image'];

        // Specify the upload directory
        $uploadDir = 'uploads/';

        // Generate unique file name
        $imagePath = $uploadDir . uniqid() . '_' . basename($image['name']);

        // Move uploaded file to the specified directory
        if (move_uploaded_file($image['tmp_name'], $imagePath)) {

            $sql = "INSERT INTO `complaint` (`name`, `number`, `text`, `image`) 
                    VALUES ('$name', '$number', '$text', '$imagePath')";

            if ($con->query($sql) === TRUE) {
                $data = array('status' => 'success');
                echo json_encode($data);
            } else {
                $data = array('status' => 'Error: ' . $con->error);
                echo json_encode($data);
            }
        } else {
            $data = array('status' => 'Error: File upload failed');
            echo json_encode($data);
        }
    } else {
        $data = array('status' => 'Error: Missing file');
        echo json_encode($data);
    }
} else {
    $data = array('status' => 'Error: Missing data');
    echo json_encode($data);
}
?>
