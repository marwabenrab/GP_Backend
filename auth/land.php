
<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
include "../connect.php";

// Set content type to JSON
header('Content-Type: application/json');

if (isset($_POST['adress']) && 
    isset($_POST['phone']) && 
    isset($_POST['status']) &&
    isset($_POST['coord_X']) &&
    isset($_POST['coord_Y'])&&
    isset($_POST['idFrmer'])
    ) {

    $adress = $_POST['adress'];
    $phone = $_POST['phone'];
    $status = $_POST['status'];
    $coordx = $_POST['coord_X'];
    $coordy = $_POST['coord_Y'];
    $idFrmer = $_POST['idFrmer'];

    // Check if files are uploaded
    if (isset($_FILES['image_own']) && isset($_FILES['image_payment'])) {
        $imageOwn = $_FILES['image_own'];
        $imagePayment = $_FILES['image_payment'];

        // Specify the upload directory
        $uploadDir = 'uploads/';

        // Generate unique file names
        $imageOwnPath = $uploadDir . uniqid() . '_' . basename($imageOwn['name']);
        $imagePaymentPath = $uploadDir . uniqid() . '_' . basename($imagePayment['name']);

        // Move uploaded files to the specified directory
        if (move_uploaded_file($imageOwn['tmp_name'], $imageOwnPath) && 
            move_uploaded_file($imagePayment['tmp_name'], $imagePaymentPath)) {

            $sql = "INSERT INTO `land` (`adress`, `phone`, `status`, `image_own`, `image_payment` ,`coord_X`, `coord_Y` ,`farmer_id`) 
                    VALUES ('$adress', '$phone', '$status', '$imageOwnPath', '$imagePaymentPath' , '$coordx',  '$coordy', `$idFrmer)";

            if ($con->query($sql) === TRUE) {
                $idLand = $con->insert_id;

                $sql = "INSERT INTO `ownership` (`id_Land`, `id_Frmer`) 
                VALUES ('$idLand', '$idFrmer')";


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
        $data = array('status' => 'Error: Missing files');
        echo json_encode($data);
    }
} else {
    $data = array('status' => 'Error: Missing data');
    echo json_encode($data);
}
?>

