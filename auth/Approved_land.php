<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
include "../connect.php";

// Set content type to JSON
header('Content-Type: application/json');

if (isset($_POST['id_land'])&& isset($_POST['approved']) ) {

    $id_land = $_POST['id_land'];
    $approved = $_POST['approved'];
   
   $sql = "UPDATE `land` SET `approved`='$approved' WHERE `id_Land`='$id_land'";

            if ($con->query($sql) === TRUE) {
                $data = array('status' => 'success');
                echo json_encode($data);
            } else {
                $data = array('status' => 'Error: ' . $con->error);
                echo json_encode($data);
            }
}else {
    $data = array('status' => 'Error: Missing data');
    echo json_encode($data);
}