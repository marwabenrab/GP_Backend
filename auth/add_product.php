<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
include "../connect.php";

// Set content type to JSON
header('Content-Type: application/json');

if (isset($_POST['id_Land']) && 
    isset($_POST['name']) &&
    isset($_FILES['image'])
    )
    {
        $image=$_FILES['image'];
        $name=$_POST['name'];
        $idLand=$_POST['id_Land'];
        $uploadDir = 'uploads/';

        $imageOwnPath = $uploadDir . uniqid() . '_' . basename($image['name']);
        if(move_uploaded_file($image['tmp_name'], $imageOwnPath)){
            $sql = "INSERT INTO `product` (`name`, `water_quantity`, `Agricultural_fertilizers`, `expectedProduct` ,`id_Land `, `image` ) 
                    VALUES ('$name', '100L', '100kg',  '3T' , '5L',  '$idLand', `$imageOwnPath)";
            if ($con->query($sql) === TRUE){
                $data = array('status' => 'success');
                echo json_encode($data);
            }
            
        }

    }

?>