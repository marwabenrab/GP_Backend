
<?php
include "../connect.php";
if( 
isset($_POST['email']) && 
isset($_POST['password'])&& 
isset($_POST['username'])&& 
isset($_POST['phone'])
)
{

$email = $_POST['email'];
$password = $_POST['password'];
$phone = $_POST['phone'];
$username = $_POST['username'];

$sql = "INSERT INTO `farmer` (`user_name`, `password`, `email`, `phone`) VALUES ('$username', '$password', '$email', '$phone') ";


if ($con->query($sql) === TRUE) {
    
    $data = array('status' => 'success');
    echo json_encode($data);
}  else {
    
    $data = array('status' => 'Error: '.$con->error);
    echo json_encode($data);
}

}else {
    $data = array('status' => 'Error: Missing Data');
    echo json_encode($data);
}
?>

