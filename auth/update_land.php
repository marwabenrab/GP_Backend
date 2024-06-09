<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
include "../connect.php";

// Set content type to JSON
header('Content-Type: application/json');

if(
    isset($_POST['id_Land'])&&
    isset($_POST['phone'])&&
    isset($_POST['adress'])
)
{
    $id=$_POST['id_Land'];
    $phone=$_POST['phone'];
    $adress=$_POST['adress'];
    $sql = "UPDATE `land` SET `phone`='$phone' , `adress`='$adress' WHERE `id_Land`='$id'";
if ($con->query($sql) === TRUE) {
    $data = array('status' => 'success');
    echo json_encode($data);
} else {
    $data = array('status' => 'Error: ' . $con->error);
    echo json_encode($data);
}
}
?>