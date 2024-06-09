<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
include "../connect.php";

// Set content type to JSON
header('Content-Type: application/json');

if(
    isset($_POST['name'])&&
    isset($_POST['email'])&&
    isset($_POST['phone'])&&
    isset($_POST['id_Farmer'])
)
{
$name=$_POST['name'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$id=$_POST['id_Farmer'];

$sql = "UPDATE `farmer` SET `user_name`='$name' , `email`='$email',`phone`='$phone' WHERE `id_Farmer`='$id'";
if ($con->query($sql) === TRUE) {
    $data = array('status' => 'success');
    echo json_encode($data);
} else {
    $data = array('status' => 'Error: ' . $con->error);
    echo json_encode($data);
}
}
else{
    echo "error";
}
?>